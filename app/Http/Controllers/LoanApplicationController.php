<?php

namespace App\Http\Controllers;

use App\DataTables\LoanApplicationDataTable;
use App\LoanApplication;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'client_id'=>'required',
            'amount_applied'=>'required',
            'amount_approved'=>'required',
            'total_interest'=>'required',
            'charges'=>'required',
            'duration'=>'required',
            'purpose'=>'required',
            'repayment_frequency'=>'required',
            'product_id'=>'required'
        ]);

        $data=$request->all()->toArray();
        $data['user_id']=Auth::id();
        $data['rate']=Product::find($request->product_id)->rate;
        return LoanApplication::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function show(LoanApplication $loanApplication)
    {
        //
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
        if($request->action === 'disburse'){
            $loanApplication->satus='DISBURSED';
            $loanApplication->disbursement_date=Carbon::now();
            $loanApplication->due_date=Carbon::now()->addMonths($loanApplication->duration);
            $loanApplication->save();
        }
        if ($request->action === 'reject'){
            $loanApplication->satus='REJECTED';
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
        //
    }

    private static function calc($term, $principle, $rate)
    {
        $daysInYear = 365;
        $amount = 0;
        $interest = 0;
        $frequency = 12;
        // formula to calculate amount: [P(1+(r/n))^(nt)]
        $amount = $principle * pow(1 + ($rate / $frequency), ($term));
        $interest = $amount - $principle;
        return json_encode(['amount' => $amount, 'interest' => $interest]);
    }
}
