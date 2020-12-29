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

Route::get('/',function(){
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
