<?php

namespace App\Http\Controllers;

use App\NextOfkin;
use Illuminate\Http\Request;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        //
        return view('superadministrator.next_of_kin',['application_id'=>$request->application_id,'client_id'=>$request->client_id]);
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
            'loan_applications_id'=>'required',
            'identification_number'=>'required',
            'identification_document'=>'required',
            'primary_contact'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'name'=>'required',
            'address'=>'required',
            'nationality'=>'required',
            'relation'=>'required'
        ]);
        try {
            $nextofkin=NextOfkin::create($request->all());
            notify()->success('Next of Kin successfully added.');
            return redirect()->route('collateral.create',['application_id'=>$request->loan_applications_id]);
        }catch (\Throwable $e){
            notify()->error('An error occurred adding Next of Kin. '.$e->getMessage());
            return redirect()->route('next-of-kin.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\NextOfkin $nextOfkin
     * @return void
     */
    public function show(NextOfkin $nextOfkin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NextOfkin  $nextOfkin
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfkin $nextOfkin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\NextOfkin           $nextOfkin
     * @return void
     */
    public function update(Request $request, NextOfkin $nextOfkin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NextOfkin  $nextOfkin
     * @return \Illuminate\Http\Response
     */
    public function destroy(NextOfkin $nextOfkin)
    {
        //
    }
}
