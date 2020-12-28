<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

    /*
        $guard = Arr::get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            case 'customer':
                $login = 'customer.login';
                break;
            case 'staff':
                $login = 'staff.login';
                break;
            default:
                $login = 'login';
                break;
        } 
        return redirect()->guest(route($login));
    */

    if ($request->is('staff') || $request->is('staff/*')) 
    {
        return redirect()->guest('/login/staff');
    }
    if ($request->is('admin') || $request->is('admin/*')) 
    {
       // return redirect()->guest('/login/admin');
        return redirect()->guest(route('admin.login'));
    }
    if ($request->is('customer') || $request->is('customer/*')) 
    {
        return redirect()->guest('/login/customer');
    }

        return redirect()->guest(route('home'));
    }
}
