<?php

namespace App\Http\Controllers;

use App\Referee;
use Illuminate\Http\Request;

class RefereeController extends Controller
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
        return Referee::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function show(Referee $referee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function edit(Referee $referee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referee  $referee
     * @return bool|\Illuminate\Http\Response
     */
    public function update(Request $request, Referee $referee)
    {
        return $referee->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Referee $referee
     * @return bool|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Referee $referee)
    {
        return $referee->delete();
    }
}
