<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check() || Auth::user()->platform !== 'Admin') {
           return redirect()->route('admin.signin');
        }

        return $next($request);
    }
}