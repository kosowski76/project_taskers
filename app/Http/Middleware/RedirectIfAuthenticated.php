<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    //  public function handle(Request $request, Closure $next, $guard = null)
    public function handle(Request $request, Closure $next, ...$guards)
    {

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
      /*    if (Auth::guard($guard)->check()) 
            {
             //   return redirect(RouteServiceProvider::HOME);
            } */

            /*
            if ($guard == "staff" && Auth::guard($guard)->check()) {
                return redirect('/staff');
            }
            if ($guard == "customer" && Auth::guard($guard)->check()) {
                return redirect('/customer');
            }
            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect('/admin');
            }
            if (Auth::guard($guard)->check()) {
                return redirect('/homex');
            }
    */
            switch ($guard) {
                case 'admin':
                    if (Auth::guard($guard)->check()) {
                        return redirect('/admin');
                    }
                    break;
                case 'customer':
                    if (Auth::guard($guard)->check()) {
                        return redirect('/customer');
                    }
                    break;
                case 'staff':
                    if (Auth::guard($guard)->check()) {
                        return redirect('/staff');
                    }
                    break;
                default:
                    if (Auth::guard($guard)->check()) {
                       // return redirect('/');
                          return redirect()->route('home');
                    }
                    break;
            }
        }

        return $next($request);
    }
}
