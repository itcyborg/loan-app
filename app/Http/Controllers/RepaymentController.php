<?php

namespace App\Http\Controllers;

use App\Clients;
use App\DataTables\RepaymentDataTable;
use App\LoanApplication;
use App\Repayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RepaymentDataTable $repaymentDataTable
     * @return \Illuminate\Http\Response
     */
    public function index(RepaymentDataTable $repaymentDataTable)
    {
        $applications=LoanApplication::with(['client'])->where('status','=','DISBURSED')->get();
        $clients=[];
        foreach ($applications as $application) {
            if(!in_array($application->client_id,$clients)){
                $clients[]=$application->client_id;
            }
        }
        $newClients=Clients::whereIn('id',$clients)->get();
        return $repaymentDataTable->render('superadministrator.repayments',['clients'=>$newClients]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        return print_r($request->all(),true);
        $this->validate($request,[
            'client'=>'required',
            'application'=>'required',
            'amount'=>'required'
        ]);
        $repayments=Repayment::where('loan_application_id',$request->application)->get();
        foreach ($repayments as $repayment) {
            $repayment->amount_paid=$request->amount;
        }
        return $repayments;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function show(Repayment $repayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Repayment $repayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repayment  $repayment
     * @return bool|\Illuminate\Http\Response
     */
    public function update(Request $request, Repayment $repayment)
    {
        $this->validate($request,[
            'amount'=>'required|numeric'
        ]);

        $amountDue=0;

        // get past repayments and check if there exists an overpayment or debt
        $previousRepayments=Repayment::where('loan_application_id',$repayment->loan_application_id)->where('amount_paid','>',0)->get();
        $totalAmountDue=0;
        $totalAmountPaid=0;
        $totalAmountDefault=0;
        foreach ($previousRepayments as $previousRepayment) {
            // sum all due amount
            if($repayment->amount_default<0){
                $repayment->amount_default=$repayment->amount_default*-1;
            }
            $totalAmountDefault=$totalAmountDefault+$previousRepayment->amount_default;
            $totalAmountDue=$totalAmountDue+$previousRepayment->amount_amount;
            $totalAmountPaid=$totalAmountPaid+$previousRepayment->amount_paid;
        }

        // amountDue= totalAmountDue+totalAmountDefault-totalAmountPaid
        $amountDue=$totalAmountDue+$totalAmountDefault-$totalAmountPaid;

        $amount=$request->amount+$repayment->amount;

        $overpayment=0;

        // check if amount is equal to amount due or more
        $data=[];
        $data['amount_paid']=$request->amount;
        $data['penalty']=0;
        $data['amount_default']=$amountDue+$request->amount;
        $data['interest']=0;

        if($repayment->update($data)){
            return "Payment has been registered successfully";
        }
        return "An error occurred.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayment $repayment)
    {
        //
    }

    public function listApplications(Request $request)
    {
        $this->validate($request,[
            'client'=>'required'
        ]);
        $applications=LoanApplication::where('client_id',$request->client)->where('status','DISBURSED')->get();
        return $applications;
    }
}
