<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Clients;
use App\DataTables\LoanApplicationDataTable;
use App\LoanApplication;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoanApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\DataTables\LoanApplicationDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(LoanApplicationDataTable $dataTable)
    {
        return $dataTable->render('superadministrator.loan_applications');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadministrator.loan_applications_create',['clients'=>Clients::all(),'products'=>Product::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'client_id'=>'required',
            'amount_applied'=>'required',
            'duration'=>'required',
            'purpose'=>'required',
            'repayment_frequency'=>'required',
            'product_id'=>'required'
        ]);

        $data=$request->all();
        $data['user_id']=Auth::id();
        $product=Product::find($request->product_id);
        $data['rate']=$product->rate;
        $data['charges']=json_encode(Charge::where('product_id',$request->product_id)->get());
        $data['total_interest']=json_decode(self::calc($request->duration,$request->amount_applied,$data['rate']))->interest;
        try{
            if($request->amount_applied>$product->max_amount || $request->amount_applied < $product->min_amount){
                notify()->warning('The amount applied is out of product range. You can apply for '.$product->min_amount.' to '.$product->max_amount);
                return redirect()->back();
            }
            $loan=LoanApplication::create($data);
            notify()->success('Client details saved');
            return redirect()->route('next-of-kin.create',['application_id'=>$loan->id,'client_id'=>$request->client_id]);
        }catch (\Throwable $e){
            notify()->error('An error occurred.'.$e->getMessage());
            return redirect()->route('loan-applications.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\LoanApplication $loanApplication
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function show($id)
    {
        $loanApplication=LoanApplication::with(['product','client','user','repayments','collaterals','guarantors','nextofkins','charges'])->find($id);
        return response()->json($loanApplication);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanApplication  $loanApplication
     * @return bool|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
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
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanApplication $loanApplication)
    {
        try {
            $loanApplication->delete();
            notify()->success('Loan application has been successfully deleted.');
        }catch (\Throwable $e){
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
        $loan_application=LoanApplication::find($request->id);
        if($request->action=='approve'){
            $validator=Validator::make($request->all(),[
                'approved_amount'=>'required'
            ]);
            if($loan_application->amount_applied>=$request->approved_amount){
            }else{
                return response()->json('The approved amount cannot be more than the applied amount.',422);
            }
            $loan_application->amount_approved=$request->approved_amount;
            $loan_application->approval_date=Carbon::now();
            $loan_application->status='APPROVED';
            $loan_application->due_date=Carbon::now()->addMonths($loan_application->duration+1);
            $loan_application->save();
            return response()->json('Approval successful',201);
        }
        if($request->action=='reject'){
            $loan_application->status='REJECTED';
            $loan_application->save();
            return response()->json('Application has been successfully marked as rejected.',201);
        }

        if($request->action == 'disburse'){
            $loan_application->status='DISBURSED';
            $loan_application->disbursement_date=Carbon::now();
            $loan_application->save();
            return response()->json('Disbursement successful',201);
        }
    }
}
