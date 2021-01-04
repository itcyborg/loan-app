<?php

namespace App\Http\Controllers;

use App\NextOfKin;
use Illuminate\Http\Request;

class NextOfKinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return NextOfKin::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function show(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfKin $nextOfKin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NextOfKin  $nextOfKin
     * @return bool|\Illuminate\Http\Response
     */
    public function update(Request $request, NextOfKin $nextOfKin)
    {
        return $nextOfKin->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\NextOfKin $nextOfKin
     * @return bool|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(NextOfKin $nextOfKin)
    {
        return $nextOfKin->delete();
    }
}
