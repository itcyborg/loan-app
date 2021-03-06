<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Clients;
use App\Collaterals;
use App\DataTables\LoanApplicationDataTable;
use App\Guarantor;
use App\Jobs\UpdateChargesApplied;
use App\LoanApplication;
use App\NextOfKin;
use App\Product;
use App\Referee;
use App\Repayment;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class LoanApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LoanApplicationDataTable $dataTable
     * @return Response
     */
    public function index(LoanApplicationDataTable $dataTable)
    {
        return $dataTable->render('superadministrator.loan_applications');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {

        $officers= User::role('administrator')->get();
        return view('applications.create',['clients'=>Clients::all(),'products'=>Product::where('status','ACTIVE')->get(),'officers'=>$officers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response|string
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'client'=>'required',
            'loanDetails.amount'=>'required',
            'loanDetails.duration'=>'required',
            'loanDetails.officer'=>'required',
            'loanDetails.purpose'=>'required',
            'loanDetails.frequency'=>'required',
            'product'=>'required',
        ]);

        $data=$request->all();
        $data['user_id']=Auth::id();
        $product=Product::find($request->product);
        $data['client_id']=$request->client;
        $data['rate']=$product->rate;
        $data['frequency']=$request->loanDetails['frequency'];
        $data['product_id']=$request->product;
        $data['amount_applied']=$request->loanDetails['amount'];
        $data['duration']=$request->loanDetails['duration'];
        $data['officer_id']=$request->loanDetails['officer'];
        $data['purpose']=$request->loanDetails['purpose'];
        $data['charges']=json_encode(Charge::where('product_id',$request->product)->get());
        $data['total_interest']=json_decode(self::calc($request->loanDetails['duration'],$request->loanDetails['amount'],$data['rate']))->interest;
        try{
            if($request->loanDetails['amount']>$product->max_amount || $request->loanDetails['amount'] < $product->min_amount){
                throw new Exception('The amount applied is out of product range. You can apply for '.$product->min_amount.' to '.$product->max_amount);
            }
            $loan=LoanApplication::create($data);
                if($loan){
                    // create next-of-kin
                    foreach ($request->next_of_kin as $kin){
                        $kin=json_decode(\GuzzleHttp\json_encode($kin));
                        $data=[
                            'client_id'=>$request->client,
                            'loan_applications_id'=>$loan->id,
                            'identification_number'=>$kin->next_of_kin_document_number,
                            'identification_document'=>$kin->next_of_kin_document,
                            'primary_contact'=>$kin->next_of_kin_contact,
                            'email'=>$kin->next_of_kin_email,
                            'gender'=>$kin->next_of_kin_gender,
                            'name'=>$kin->next_of_kin_name,
                            'address'=>$kin->next_of_kin_address,
                            'nationality'=>$kin->next_of_kin_nationality,
                            'relation'=>$kin->next_of_kin_relation
                        ];
                        $next_of_kin=NextOfKin::create($data);
                    }
                    // create collateral
                    foreach ($request->collaterals as $collateral) {
                        $collateral=json_decode(json_encode($collateral));
                        $data=[
                            'application_id'=>$loan->id,
                            'type'=>$collateral->collateral_type,
                            'details'=>$collateral->collateral_details,
                            'value'=>$collateral->collateral_value
                        ];
                        $col=Collaterals::create($data);
                    }
                    // create guarantor
                    foreach ($request->guarantors as $guarantor) {
                        $rawData=json_decode(json_encode($guarantor));
                        $data=[
                            'name'=>$rawData->guarantor_name,
                            'application_id'=>$loan->id,
                            'identification_number'=>$rawData->guarantor_id_number,
                            'identification_document'=>$rawData->guarantor_id_document,
                            'contact'=>$rawData->guarantor_contact
                        ];
                        $gtr=Guarantor::create($data);
                    }
                    // create referee
                    foreach ($request->referees as $referee) {
//                        dd($referee);
                        $rawData=json_decode(json_encode($referee));
                        $data=[
                            'name'=>$rawData->name,
                            'nationality'=>$rawData->nationality,
                            'contact'=>$rawData->contact,
                            'alternate_contact'=>$rawData->alternate_contact,
                            'location'=>$rawData->location,
                            'loan_id'=>$loan->id
                        ];
                        $rfr=Referee::create($data);
                    }
                }
                return json_encode(['status'=>'success','message'=>'Loan application saved successfully'],200);
        }catch (Throwable $e){
            return response(['status'=>'error','message'=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param LoanApplication $loanApplication
     *
     * @return JsonResponse|void
     */
    public function show($id)
    {
        $loanApplication=LoanApplication::with(['product','client','user','repayments','collaterals','guarantors','nextofkins','charges','referees'])->find($id);
        return response()->json($loanApplication);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LoanApplication $loanApplication
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(LoanApplication $loanApplication)
    {
        if($loanApplication->status=='PENDING') {
            notify()->success('Loan Application has been cancelled.');
            $loanApplication->status='CANCELLED';
            $loanApplication->save();
        }else{
            notify()->error('Loan Application cannot be cancelled at this stage.');
        }
        return redirect('/loan-applications');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request         $request
     * @param LoanApplication $loanApplication
     *
     * @return bool|JsonResponse|Response
     */
    public function update(Request $request, LoanApplication $loanApplication)
    {
        if(!$loanApplication){
            return response()->json(['message'=>'Loan application not found'],404);
        }
        if($request->action === 'update'){
            if($loanApplication){
                return $loanApplication->update($request->all());
            }
        }
        // todo enforce roles checking
        if($request->action === 'approve'){
            $loanApplication->status='APPROVED';
            $loanApplication->amount_approved=$request->amount_approved;
            $calcResults=self::calc($loanApplication->duration,$loanApplication->amount_approved,$loanApplication->rate);
            $loanApplication->total_interest=$calcResults->interest;
            $loanApplication->approval_date=Carbon::now();
            $loanApplication->save();
        }
        if($request->action == 'disburse'){
            $loanApplication->status='DISBURSED';
            $loanApplication->disbursement_date=Carbon::now();
            $loanApplication->due_date=Carbon::now()->addMonths($loanApplication->duration);
            $loanApplication->save();
        }
        if ($request->action === 'reject'){
            $loanApplication->status='REJECTED';
            $loanApplication->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LoanApplication  $loanApplication
     *
     * @return Response
     */
    public function destroy(LoanApplication $loanApplication)
    {
        try {
            $loanApplication->delete();
            notify()->success('Loan application has been successfully deleted.');
        }catch (Throwable $e){
            notify()->error('An error occurred trying to delete the loan application.');
        }
        return redirect()->back();
    }

    private static function calc($term, $principle, $rate)
    {
        $daysInYear = 365;
        $amount = 0;
        $interest = 0;
        $frequency = 12;
        $rate=$rate/100;
        // formula to calculate amount: [P(1+(r/n))^(nt)]
        $amount = $principle * pow(1 + ($rate / $frequency), ($term));
        $interest = $amount - $principle;
        return json_encode(['amount' => $amount, 'interest' => $interest]);
    }

    public function actions(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
            'action'=>'required'
        ]);
        $loan_application=LoanApplication::with(['collaterals','nextofkins','guarantors'])->find($request->id);
        if($request->action=='approve'){
            $validator=Validator::make($request->all(),[
                'approved_amount'=>'required',
                'duration'=>'required'
            ]);

            if($loan_application->collaterals->count()<1){
                return response()->json(['message'=>'The loan application does not have a collateral on file.'],419);
            }
            if($loan_application->nextofkins->count()<1){
                return response()->json(['message'=>'The loan application does not have a next-of-kin on file.'],419);
            }
            if($loan_application->guarantors->count()<1){
                return response()->json(['message'=>'The loan application does not have a guarantor on file.'],419);
            }
            if($loan_application->amount_applied>=$request->approved_amount){
            }else{
                return response()->json('The approved amount cannot be more than the applied amount.',422);
            }

            $loan_application->product_config=$loan_application->product()->get();
            $loan_application->charges_config=$loan_application->charges()->get();
            $loan_application->duration=$request->duration;
            $loan_application->amount_approved=$request->approved_amount;
            $loan_application->approval_date=Carbon::now();
            $calcResults=json_decode(self::calc($loan_application->duration,$loan_application->amount_approved,$loan_application->rate));
            $loan_application->total_interest=$calcResults->interest;
            $loan_application->status='APPROVED';
            $loan_application->due_date=Carbon::now()->addMonths($loan_application->duration+1);
            $loan_application->approved_by=Auth::id();


            $loan_application->disbursed_amount=$this->calculateDisbursalAmount($loan_application);

            $loan_application->save();
            return response()->json('Approval successful',201);
        }
        if($request->action=='reject'){
            $loan_application->status='REJECTED';
            $loan_application->approved_by=Auth::id();
            $loan_application->save();
            return response()->json('Application has been successfully marked as rejected.',201);
        }

        if($request->action == 'disburse'){
            $loan_application->channel=$request->channel;
            $loan_application->account=$request->account;
            if($loan_application->channel!="" && $loan_application->channel!==null && $loan_application->account!=='' && $loan_application->account!=null) {
                $loan_application->status = 'DISBURSED';
                $loan_application->disbursement_date = Carbon::now();
                $loan_application->disbursed_by = Auth::id();
                $loan_application->save();

                // create the schedule
                $this->schedule($loan_application);

                dispatch(new UpdateChargesApplied());

                return response()->json('Disbursement successful', 201);
            }else{
                return response()->json('An error occurred',422);
            }
        }
    }

    public function schedule($loan)
    {
        $currentMonth=Carbon::parse($loan->disbursement_date);
        $duration=$loan->duration;
        $amount=$loan->amount_approved/$duration;
        $last_repayment=null;
        for ($i=1;$i<=$duration;$i++){
            $currentMonth=$currentMonth->addMonth();
            $last_repayment=Repayment::create([
                'loan_application_id'=>$loan->id,
                'due_date'=>$currentMonth,
                'amount'=> number_format($amount,0,'.',',')
            ]);
        }

        $total_to_pay=Repayment::where('loan_application_id',$loan->id)->sum('amount');
        $difference=ceil($loan->amount_approved-$total_to_pay);

        if($difference>0){
            $last_repayment->amount=$last_repayment->amount+$difference;
            $last_repayment->save();
        }
    }

    public function applications(Request $request)
    {
        $this->validate($request,[
            'client_id'=>'required'
        ]);

        $applications= LoanApplication::where('client_id',$request->client_id)->where('status','DISBURSED')->get();
        if($applications->count()==0){
            return response('No application found',404);
        }
        return $applications;
    }

    private function calculateDisbursalAmount($loan_application)
    {
        $charges=$loan_application->charges_config;
        if(count($charges)>0) {
            $total_charge = 0;
            foreach ($charges as $charge) {
                if ($charge['type'] == 'PERCENTAGE') {
                    $total_charge += $charge['amount'] * $loan_application->amount_approved / 100;
                } else {
                    $total_charge += $charge['amount'];
                }
            }
        }
        return floor($loan_application->amount_applied-($total_charge+$loan_application->total_interest));
    }
}
