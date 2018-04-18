<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle($request, Closure $next, $role, $guard = null)
    {

        //  if (!$request->user()->hasRole($role)) {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            return redirect('/'); // редирект куда угодно
        }
        return $next($request);
    }
}
