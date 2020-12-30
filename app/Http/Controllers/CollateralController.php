<?php

namespace App\Http\Controllers;

use App\Collateral;
use Illuminate\Http\Request;

class CollateralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        return Collateral::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collateral  $collateral
     * @return \Illuminate\Http\Response
     */
    public function show(Collateral $collateral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collateral  $collateral
     * @return \Illuminate\Http\Response
     */
    public function edit(Collateral $collateral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collateral  $collateral
     * @return bool|\Illuminate\Http\Response
     */
    public function update(Request $request, Collateral $collateral)
    {
        return $collateral->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Collateral $collateral
     * @return bool|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Collateral $collateral)
    {
        return $collateral->delete();
    }
}
