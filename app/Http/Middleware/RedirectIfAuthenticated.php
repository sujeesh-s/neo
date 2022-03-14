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
    public function handle(Request $request, Closure $next, ...$guards)
    {
        header("Access-Control-Allow-Origin: *");
$headers = [
'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
];

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect('/admin/dashboard');
            }
            if ($guard == "organization" && Auth::guard($guard)->check()) {
                return redirect('/organization/dashboard');
            }
            if (Auth::guard($guard)->check()) {
                return redirect('/home');
            }

        }

        return $next($request);
    }
//    public function handle($request, Closure $next, $guard = null)
//        {
//            if ($guard == "admin" && Auth::guard($guard)->check()) {
//                return redirect('/admin');
//            }
//            if ($guard == "seller" && Auth::guard($guard)->check()) {
//                return redirect('/seller');
//            }
//            if (Auth::guard($guard)->check()) {
//                return redirect('/home');
//            }
//    
//            return $next($request);
//        }
}
