<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
        'next_of_kin'=>'NextOfKinController'
    ]);
