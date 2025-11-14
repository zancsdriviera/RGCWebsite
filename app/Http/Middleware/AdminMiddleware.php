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
            return redirect()->route('admin.index')
                ->withErrors(['Please login first!']);
        }
        return $next($request);
    }
}
