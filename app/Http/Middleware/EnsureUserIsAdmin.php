<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //dd('This is EnsureUserIsAdmin middleware');
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
