<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,   ...$params): Response
    {
        foreach ($params as $role) {
            if (Auth::check() && Auth::user()->role_id == (int)$role) {
                return $next($request);
            }
        }
        return redirect()->back()->with("warning", "You  don't have permission to access this");

    }
}