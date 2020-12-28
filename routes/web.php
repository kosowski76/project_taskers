<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\SiteController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Web\Staff\StaffTaskController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\Web\Admin\AdminLoginController;
use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Customer\CustomerProjectController;

use App\Http\Controllers\Web\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

/*
Route::get('/', function () {
    //   return view('welcome');
    return 'welcome';
}); */

Route::namespace('Web')->group(function () {

    Route::get('/', [SiteController::class, 'index'])->name('home');

    Auth::routes([
        'reset'  => true,
        //   'verify' => true
    ]);
    /*
    Route::get('/login/writer', 'LoginController@showWriterLoginForm');
    Route::post('/login/writer', 'LoginController@writerLogin');

    Route::get('/register/writer', 'RegisterController@showWriterRegisterForm');
    Route::post('/register/writer', 'RegisterController@createWriter');
*/
    Route::get('/login/staff', [LoginController::class, 'showStaffLoginForm'])->name('staff.login');
    Route::post('/login/staff', [LoginController::class, 'staffLogin'])->name('staff.login.post');

    Route::get('/login/customer', [LoginController::class, 'showCustomerLoginForm'])->name('customer.login');
    Route::post('/login/customer', [LoginController::class, 'customerLogin'])->name('customer.login.post');

    //Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
    //Route::post('/login/admin', [LoginController::class, 'adminLogin']);

    // require 'web/staff.php';
    Route::prefix('/staff')->group(function () {
        /*
        Route::get('/sign-in', [StaffLoginController::class, 'showStaffLoginForm'])->name('staff.login');
        Route::post('/sign-in', [StaffLoginController::class, 'signIn'])->name('staff.login.post');
        Route::post('/sign-out', [StaffLoginController::class, 'signOut'])->name('staff.logout');
*/
        //unauthenticated routes for customers here
        Route::group(['middleware' => ['auth:staff']], function () {

            // /staff
            Route::get('/', [StaffTaskController::class, 'dashboard'])->name('staff.dashboard');

            // require 'staffTasks.php' 
            Route::prefix('/tasks')->group(function () {

                // /staff/tasks
                Route::get('/', function () {
                    return redirect(route('staff.tasks.index', 301));
                });

                // /staff/tasks/list/{type?}
                Route::get('/list/{type?}', [StaffTaskController::class, 'index'])->name('staff.tasks.index');

                // /staff/tasks/add
                Route::get('/add', [StaffTaskController::class, 'add'])->name('staff.tasks.add');

                // /tasks/store
                Route::post('/store', [StaffTaskController::class, 'store'])->name('staff.tasks.store');

                // /tasks/{task}
                Route::get('/{task}', [StaffTaskController::class, 'show'])->name('staff.tasks.show');

                // /tasks/{task}/edit
                Route::get('/{task}/edit', [StaffTaskController::class, 'edit'])->name('staff.tasks.edit');

                // /tasks/{task}
                Route::put('/{task}', [StaffTaskController::class, 'update'])->name('staff.tasks.update');

                // /tasks/{task}
                Route::delete('/{task}', [StaffTaskController::class, 'delete'])->name('staff.tasks.delete');

            });

        });

    }); // end  Route::prefix('/staff')


    // require 'staff.php' - 'tasks.php' 
    Route::prefix('/tasks')->group(function () {

        /*    // /tasks  
        Route::get('/', function () {
            return redirect(route('tasks.index', 301));
        }); */

        // /tasks/list/{type?}
        //    Route::get('/list/{type?}', [TaskController::class, 'index'])->name('tasks.index');

        // /tasks/add
        //    Route::get('/add', [TaskController::class, 'add'])->name('tasks.add');

        // /tasks/store
        //    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');

        // /tasks/{task}
        //   Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');

        // /tasks/{task}/edit
        //   Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

        // /tasks/{task}
        //    Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');

        // /tasks/{task}
        //    Route::delete('/{task}', [TaskController::class, 'delete'])->name('tasks.delete');
    });


    Route::group(['prefix' => 'customer'], function () {

        //   Route::get('/sign-in', [CustomerLoginController::class, 'showCustomerLoginForm'])->name('customer.login');

        //unauthenticated routes for customers here
        Route::group(['middleware' => ['auth:customer']], function () {

            // /customer
            Route::get('/', [CustomerProjectController::class, 'dashboard'])->name('customer.dashboard');
        });
    });


    //require 'web/admin.php';
    Route::group(['prefix' => 'admin'], function () {

        Route::get('sign-in', [AdminLoginController::class, 'showAdminLoginForm'])->name('admin.login');
        Route::post('sign-in', [AdminLoginController::class, 'signIn'])->name('admin.login.post');
        Route::get('sign-out', [AdminLoginController::class, 'signOut'])->name('admin.logout');


        //unauthenticated routes for customers here 
        Route::group(['middleware' => ['auth:admin']], function () {

            Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        });
    });
});
