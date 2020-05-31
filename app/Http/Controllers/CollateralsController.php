<?php

namespace App\Http\Controllers;

use App\Collaterals;
use Illuminate\Http\Request;

class CollateralsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Collaterals::all();
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
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'application_id'=>'required',
            'type'=>'required',
            'details'=>'required',
            'value'=>'required|number'
        ]);

        return Collaterals::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collaterals  $collaterals
     * @return \Illuminate\Http\Response
     */
    public function show(Collaterals $collaterals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collaterals  $collaterals
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaterals $collaterals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collaterals  $collaterals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collaterals $collaterals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collaterals  $collaterals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaterals $collaterals)
    {
        //
    }
}
