<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     protected function redirectTo(Request $request): ?string
    {
        if (!Auth::check()) {
            return redirect('/login')->getTargetUrl();
        }
        if (Auth::check()) {
            if(Auth::user()->platform == 'Pass') {
                return redirect('/pass/dashboard')->getTargetUrl();
            }
        }
        return $next($request);
    }

}
