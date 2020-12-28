<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use \Illuminate\Auth\AuthenticationException;
use \Laravel\Passport\Exceptions\MissingScopeException;
use Closure;

class CheckForAllScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next 
     * @param  mixed  ...$scope
     * @return  \Illuminate\Http\Response
     * 
     * @throws \Illuminate\Auth\AuthenticationException|\Laravel\Passport\Exceptions\MissingScopeException
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        if (!$request->user() || !$request->user()->token()) {
            throw new AuthenticationException;
        }

        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response(array("message" => "Not Authorized."), 403);
        //return $next($request);
    }
}
