<?php

    use Illuminate\Http\Request;
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
    Route::get('reports/user','ReportController@getAgentReports');
    Route::get('loan',function(){
        $clients=\App\Clients::all();
        $products=\App\Product::all();
        $officers=\App\User::role('administrator')->get();
        $data=['clients'=>$clients,'products'=>$products,'officers'=>$officers];
        return view('applications.create',$data);
    });
    Route::get('home', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'role:superadministrator'], function () {
            Route::get('reports/data','ReportController@getData');
//            Route::get('reports/user','ReportController@getAgentReports');
            Route::resources([
                'users' => 'UsersController',
                'products' => 'ProductController',
                'roles' => 'RolesController',
                'permissions' => 'PermissionsController',
                'charges'=>'ChargeController',
                'reports'=>'ReportController'
            ]);
            Route::post('products/activate','ProductController@activate');
        });
        Route::resources([
            'client' => 'ClientsController',
            'next-of-kin' => 'NextOfKinController',
            'collateral' => 'CollateralsController',
            'guarantor' => 'GuarantorController',
            'repayment'=>'RepaymentController'
        ]);
        Route::post('loan-applications/actions','LoanApplicationController@actions')->name('loan-applications.action');
        Route::post('client-applications','RepaymentController@listApplications');
    });
    Route::post('users/actions','UsersController@actions')->name('users.actions');
    Route::post('clientinfo','ClientsController@info');
    Route::post('productinfo','ProductController@info');

    Route::resources([
        'loan-applications' => 'LoanApplicationController',
    ]);
    //to remove
    Route::post('loan',function(Request $request){
        dd($request->all());
    });
