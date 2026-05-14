<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            abort(403);
        }

        if (Auth::user()->tipo !== $role) {
            abort(403, 'No tienes permisos para acceder a esto');
        }

        return $next($request);
    }

    public function handle($request, Closure $next, $role)
{
    if (!auth()->check() || auth()->user()->tipo !== $role) {
        abort(403);
    }

    return $next($request);
}
}
