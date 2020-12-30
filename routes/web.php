<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register'=>false]);
Route::get('/',function(){
    return json_encode([
        'product_id'=>1,
        'rate'=>12,
        'purpose'=>'fees',
        'amount_applied'=>12000,
        'duration'=>6,
        'repayment_frequency'=>'monthly',
        'customer_id'=>1,
        'applied_by'=>1,
        'product_config'=>'test',
    ]);
    return view('welcome');
});
Route::resources([
    'charge'=>'ChargeController',
    'collateral'=>'CollateralController',
    'customer' =>'CustomerController',
    'disbursement'=>'DisbursementController',
    'guarantor'=>'GuarantorController',
    'loan'=>'LoanController',
    'product'=>'ProductController',
    'referee'=>'RefereeController',
    'repayment'=>'RepaymentController',
    'revenue' =>'RevenueController',
    'user'=>'UserController',
]);
