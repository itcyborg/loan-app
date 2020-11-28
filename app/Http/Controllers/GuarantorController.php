<?php

namespace App\Http\Controllers;

use App\Guarantor;
use Illuminate\Http\Request;

class GuarantorController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('superadministrator.guarantor_create',['application_id'=>$request->application_id]);
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
            'name'=>'required',
            'application_id'=>'required',
            'identification_number'=>'required',
            'identification_document'=>'required',
            'contact'=>'required'
        ]);
        try {
            $guarantor=Guarantor::create($request->all());
            notify()->success('Guarantor added successfully');
            return redirect()->route('loan-applications.index');
        }catch (\Throwable $e){
            notify()->error('An error occurred adding guarantor.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Guarantor $guarantor
     * @return void
     */
    public function show(Guarantor $guarantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Guarantor $guarantor
     * @return void
     */
    public function edit(Guarantor $guarantor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Guarantor           $guarantor
     * @return void
     */
    public function update(Request $request, Guarantor $guarantor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Guarantor $guarantor
     * @return void
     */
    public function destroy(Guarantor $guarantor)
    {
        //
    }
}
