<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        if (!session()->get('gw_admin')) {
            return redirect('/login');
        }
        return $next($request);
    }
}
