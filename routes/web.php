<?php

    use Illuminate\Support\Facades\Auth;
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

    Auth::routes(['register'=>false,'reset'=>true]);
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('home', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'role:superadministrator'], function () {
            Route::resources([
                'users' => 'UsersController',
                'products' => 'ProductController',
                'roles' => 'RolesController',
                'permissions' => 'PermissionsController'
            ]);
        });
        Route::resources([
            'client' => 'ClientsController',
            'next-of-kin' => 'NextOfKinController',
            'loan-applications' => 'LoanApplicationController',
            'collateral' => 'CollateralsController',
            'guarantor' => 'GuarantorController'
        ]);
        Route::post('loan-applications/actions','LoanApplicationController@actions')->name('loan-applications.action');
    });

