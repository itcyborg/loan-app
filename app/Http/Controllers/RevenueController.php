<?php

namespace App\Http\Controllers;

use App\DataTables\RevenueDatatable;
use App\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RevenueDatatable $revenueDatatable
     * @return \Illuminate\Http\Response
     */
    public function index(RevenueDatatable $revenueDatatable)
    {
        return $revenueDatatable->render('revenue.index');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category'=>'required',
            'type'=>'required',
            'amount'=>'required|numeric|gt:0',
            'comment'=>'required'
        ]);

        if(Revenue::create($request->all())){
            notify()->success('Entry has been added successfully.');
        }else{
            notify()->error('An error occurred adding entry.');
        }
        return view('revenue.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function edit(Revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revenue $revenue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revenue $revenue)
    {
        //
    }
}
