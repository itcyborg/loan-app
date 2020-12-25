<?php

namespace App\Http\Controllers;

use App\Clients;
use App\DataTables\RepaymentDataTable;
use App\LoanApplication;
use App\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repayment $repayment)
    {
        //
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
