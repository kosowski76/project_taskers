<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiLoginController;
use App\Http\Controllers\Api\CustomerApiProjectController;
use App\Http\Controllers\Api\StaffApiLoginController;
//use App\Http\Controllers\Api\StaffHostController;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/', function () 
 { return view('login'); } )->name('login-api');


    Route::group(['prefix' => 'customer-api'], function(){

        Route::get('/', [CustomerApiLoginController::class, 'index'])->name('customer-api.index');
        Route::post('sign-in', [CustomerApiLoginController::class, 'signIn'])->name('customer-api.signin');

        //unauthenticated routes for customers here
        Route::group(['middleware' => ['auth:customer-api', 'scope:customer'] ], function(){

            // authenticated customer routes here 
            //   Route::post( 'dashboard', [CustomerApiLoginController::class, 'dashboard'] )->name( 'customer-api-log.dashboard' );
            Route::post('dashboard', [CustomerApiProjectController::class, 'dashboard'])->name('customer-api.dashboard');
            Route::get('projects/{id}', [CustomerApiProjectController::class, 'show'])->name('customer-api.show');
            Route::post('projects', [CustomerApiProjectController::class, 'store'])->name('customer-api.store');
            Route::post('projects/{id}', [CustomerApiProjectController::class, 'update'])->name('customer-api.update');
            Route::delete('projects/{id}', [CustomerApiProjectController::class, 'destroy'])->name('customer-api.destroy');    
        });
    });
    
    Route::group(['prefix' => 'staff-api'], function(){

        Route::get('/', [StaffApiLoginController::class, 'index'])->name('staff-api.index');
        Route::post('sign-in', [StaffApiLoginController::class, 'signIn'])->name('staff-api.signin');

        //unauthenticated routes for staff here 
        Route::group(['middleware' => ['auth:staff', 'scope:staff'] ], function(){

            // authenticated staff routes here 
            Route::post('dashboard', [StaffHostController::class, 'dashboard'])->name('staff-api.dashboard');
            Route::get('hosts/{id}', [StaffHostController::class, 'show'])->name('staff-api.show');
            Route::post('hosts', [StaffHostController::class, 'store'])->name('staff-api.store');
            Route::post('hosts/{id}', [StaffHostController::class, 'update'])->name('staff-api.update');
            Route::delete('hosts/{id}', [StaffHostController::class, 'destroy'])->name('staff-api.destroy');
        });
    });
