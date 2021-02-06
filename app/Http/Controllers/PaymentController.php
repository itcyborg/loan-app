<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDatatable;
use App\Jobs\CalculatePenalties;
use App\Jobs\CalculateTotalRepayment;
use App\Payment;
use App\Providers\App\Events\PaymentReceivedEvent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PaymentDatatable $paymentDatatable
     *
     * @return Response
     */
    public function index(PaymentDatatable $paymentDatatable)
    {
        return $paymentDatatable->render('superadministrator.payments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('superadministrator.create_payments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'amount'=>'required|numeric',
            'application_id'=>'required',
            'client_id'=>'required'
        ]);

        $payment=Payment::create([
            'client_id'=>$request->client_id,
            'loan_application_id'=>$request->application_id,
            'amount'=>$request->amount
        ]);

        CalculatePenalties::dispatchNow();

        event(new PaymentReceivedEvent($payment));

        return response('Payment successfully recorded.',200);
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     *
     * @return Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Payment $payment
     *
     * @return Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Payment $payment
     *
     * @return Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Payment  $payment
     *
     * @return Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
