<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Product;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Loan::with(['client','product','officer'])->get();
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
        $product=Product::find(request('product_id'));
        if(!$product){
            return response('Product not found.',400);
        }
        if($product->status!=='ACTIVE'){
            return response('Product not active.',400);
        }
        $data=[
            'product_id'=>request('product_id'),
            'purpose'=>request('purpose'),
            'amount_applied'=>request('amount_applied'),
            'duration'=>request('duration'),
            'customer_id'=>request('customer_id'),
            'product_config'=>$product,
            'rate'=>$product->rate
        ];
        return Loan::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        return $loan->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        return $loan->delete();
    }
}
