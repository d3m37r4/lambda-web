<?php

namespace App\Http\Middleware;

use Closure;

class SetUserLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            app()->setLocale(auth()->user()->locale);
        }

        elseif (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        return $next($request);
    }
}
