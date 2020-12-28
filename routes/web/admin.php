<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminLoginController;

Route::group(['prefix' => 'admin'], function(){
    
    Route::get('sign-in', [AdminLoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('sign-in', [AdminLoginController::class, 'signIn'])->name('admin.signin.post');
    Route::get('sign-out', [AdminLoginController::class, 'signOut'])->name('admin.signout');

    //unauthenticated routes for customers here
    Route::group(['middleware' => ['auth:admin', 'scope:admin'] ], function(){

       Route::get('/', function () {
            return view('admin.dashboard.index')->name('admin.dashboard');
        });
    
    });

});