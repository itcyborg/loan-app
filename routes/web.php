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
    Route::get('loan',function(){
        $clients=\App\Clients::all();
        $products=\App\Product::all();
        $data=['clients'=>$clients,'products'=>$products];
        return view('applications.create',$data);
    });
    Route::get('home', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'role:superadministrator'], function () {
            Route::resources([
                'users' => 'UsersController',
                'products' => 'ProductController',
                'roles' => 'RolesController',
                'permissions' => 'PermissionsController',
                'charges'=>'ChargeController'
            ]);
            Route::post('products/activate','ProductController@activate');
        });
        Route::resources([
            'client' => 'ClientsController',
            'next-of-kin' => 'NextOfKinController',
            'loan-applications' => 'LoanApplicationController',
            'collateral' => 'CollateralsController',
            'guarantor' => 'GuarantorController',
            'repayment'=>'RepaymentController'
        ]);
        Route::post('loan-applications/actions','LoanApplicationController@actions')->name('loan-applications.action');
    });
    Route::post('users/actions','UsersController@actions')->name('users.actions');
    Route::post('clientinfo','ClientsController@info');
    Route::post('productinfo','ProductController@info');

