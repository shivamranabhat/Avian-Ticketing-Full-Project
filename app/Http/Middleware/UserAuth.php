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
     public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('pass.login');
        }

        $user = Auth::user();

        if (
            $user->platform === 'Pass' &&
            !$request->routeIs('pass.*')
        ) {
            return redirect()->route('pass.dashboard');
        }

        return $next($request);
    }

}
