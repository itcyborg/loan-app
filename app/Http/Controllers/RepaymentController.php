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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RepaymentDataTable $repaymentDataTable)
    {
        $applications = LoanApplication::with(['client'])->where('status', '=', 'DISBURSED')->get();
        $clients = [];
        foreach ($applications as $application) {
            if (!in_array($application->client_id, $clients)) {
                $clients[] = $application->client_id;
            }
        }
        $newClients = Clients::whereIn('id', $clients)->get();
        return $repaymentDataTable->render('superadministrator.repayments', ['clients' => $newClients]);
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
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        return print_r($request->all(),true);
        $this->validate($request, [
            'client' => 'required',
            'application' => 'required',
            'amount' => 'required'
        ]);
        $repayments = Repayment::where('loan_application_id', $request->application)->get();
        foreach ($repayments as $repayment) {
            $repayment->amount_paid = $request->amount;
        }
        return $repayments;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Repayment $repayment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Repayment $repayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Repayment $repayment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Repayment $repayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Repayment           $repayment
     *
     * @return bool|\Illuminate\Http\Response
     */
    public function update(Request $request, Repayment $repayment)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        $amountDue = 0;

        // get payments due today and the past
        $previousRepayments = Repayment::where('loan_application_id', $repayment->loan_application_id)->whereDate('due_date', '<=', Carbon::now())->where('status', 0)->get();
        $amount = $request->amount;
        $default = 0;


        // loop through checking if the amount paid is equal or more than the amount to pay
        foreach ($previousRepayments as $previousRepayment) {
            # get the amount paid if any
            $amountPaid = $previousRepayment->amount_paid;

            # get the amount default
            $amountDefault = $previousRepayment->amount_default;

            # get the total to pay
            $amountToPay = $previousRepayment->total_to_pay;

            # check if amount to pay is equal to request amount
            if ($amount > $amountToPay) {
                # set the amount paid to amount due
                $repayment->amount_paid = $repayment->amount_paid + $amount;
                $repayment->amount_default = ($amountToPay - $amount);
                $repayment->status = 1;
                $repayment->save();

                # set the amount to the balance remaining
                $amount = $amount - $amountToPay;
            }
            if ($amount == $amountToPay) {
                # set the amount paid to amount due
                $repayment->amount_paid = $repayment->amount_paid + $amount;
                $repayment->amount_default = 0;
                $repayment->status = 1;
                $repayment->save();

                # set the amount to 0; no money left
                $amount = 0;
            }
            if ($amount < $amountToPay) {

                # set the amount paid to amount due
                $repayment->amount_paid = $repayment->amount_paid + $amount;
                $repayment->amount_default = ($amountToPay - $amount);
                $repayment->status = 0;
                $repayment->save();

                # set the amount to 0; no money left
                $amount = 0;
            }
        }

        // check if amount is more than 0

        if ($amount > 0) {
            # get the next payment to be made and register it in the amount paid
            $nextPayment = Repayment::where('loan_application_id', $repayment->loan_application_id)->whereDate('due_date', '>', Carbon::now())->where('status', 0)->orderBy('due_date', 'asc')->first();
            if ($nextPayment) {
                $nextPayment->amount_paid = $amount;
                $nextPayment->save();
            }
        }

        return "Payment has been registered successfully";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Repayment $repayment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayment $repayment)
    {
        //
    }

    public function listApplications(Request $request)
    {
        $this->validate($request, [
            'client' => 'required'
        ]);
        $applications = LoanApplication::where('client_id', $request->client)->where('status', 'DISBURSED')->get();
        return $applications;
    }
}
