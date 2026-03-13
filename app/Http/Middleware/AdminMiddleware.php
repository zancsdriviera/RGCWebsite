<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('admin')) {
            abort(403, 'Your session has expired. Please log in again to view this page.');
        }

        return $next($request);
    }
}
