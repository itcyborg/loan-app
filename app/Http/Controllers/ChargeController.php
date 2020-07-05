<?php

namespace App\Http\Controllers;

use App\Charge;
use App\DataTables\ChargeDatatable;
use App\Product;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\DataTables\ChargeDatatable $chargeDatatable
     * @return \Illuminate\Http\Response
     */
    public function index(ChargeDatatable $chargeDatatable)
    {
        return $chargeDatatable->render('superadministrator.charges',['products'=>Product::all()]);
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'amount'=>'numeric',
            'type'=>'required',
            'product_id'=>'required'
        ]);
        try {
            Charge::create($request->all());
            notify()->success('Charge has been successfully created.');
            return redirect()->back();
        }catch (\Throwable $e){
            notify()->error('Charge operation failed. Error: '.$e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function show(Charge $charge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function edit(Charge $charge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Charge $charge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Charge $charge)
    {
        try {
            $charge->delete();
            notify()->success('The charge has been successfully deleted.');
            return redirect()->back();
        }catch (\Throwable $e){
            notify()->error('The charge failed to be deleted. Error: '.$e->getMessage());
            return redirect()->back();
        }
    }
}
