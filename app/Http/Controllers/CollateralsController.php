<?php

namespace App\Http\Controllers;

use App\Collaterals;
use Illuminate\Http\Request;

class CollateralsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Collaterals[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {

        return Collaterals::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('superadministrator.collateral_create',['application_id'=>$request->application_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'application_id'=>'required',
            'type'=>'required',
            'details'=>'required',
            'value'=>'required|numeric'
        ]);
        try {
            $collateral=Collaterals::create($request->all());
            notify()->success('Collateral has been successfully added.');
            return redirect()->route('guarantor.create',['application_id'=>$request->application_id]);
        }catch (\Throwable $e){
            notify()->error('An error occurred');
            return redirect()->route('collateral.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Collaterals $collaterals
     * @return void
     */
    public function show(Collaterals $collaterals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Collaterals $collaterals
     * @return void
     */
    public function edit(Collaterals $collaterals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Collaterals         $collaterals
     * @return void
     */
    public function update(Request $request, Collaterals $collaterals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Collaterals $collaterals
     * @return void
     */
    public function destroy(Collaterals $collaterals)
    {
        //
    }
}
