<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if the user is authenticated and has the required role
        if (!Auth::check() || !Auth::user()->roles()->where('name', $role)->exists()) {
            // If the user is not authorized, return a 403 Forbidden response
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // If the user has the required role, allow the request to proceed
        return $next($request);
    }
}