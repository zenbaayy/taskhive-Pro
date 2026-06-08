<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            // Agar user logged in nahi hai ya uska role match nahi karta
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}