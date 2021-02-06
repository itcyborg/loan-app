<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductDataTable $dataTable
     *
     * @return Response
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('superadministrator.products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'code'=>'required|unique:products,code',
            'min_amount'=>'required',
            'max_amount'=>'required',
            'rate'=>'required',
            'min_duration'=>'required',
            'max_duration'=>'required',
            'security'=>'required'
        ]);
        try{
            Product::create($request->all());
            notify()->success('The product was successfully added.');
        }catch (Throwable $e){
            notify()->error('An error occurred adding a product.');
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     *
     * @return Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     *
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param  Product $product
     *
     * @return JsonResponse|Response
     */
    public function update(Request $request, Product $product)
    {
        if($product->update($request->all())){
            return response()->json('Product update successful',200);
        }
        return response()->json('Product update failed',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product  $product
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Product $product)
    {
        $product->delete();
        notify()->success('Product has been deleted');
        return redirect('/products');
    }

    public function activate(Request $request)
    {
        $product=Product::findOrFail($request->id);
        $slug='';
        if($request->action=='activate') {
            $product->status = 'ACTIVE';
            $slug='activated';
        }else{
            $product->status = 'INACTIVE';
            $slug='deactivated';
        }
        if($product->save()){
            return response()->json('Product successfully '.$slug);
        }
        return response()->json('Product activation failed');
    }

    public function info(Request  $request)
    {
        $this->validate($request,['id'=>'required']);
        return Product::findOrFail($request->id)->toJson();
    }
}
