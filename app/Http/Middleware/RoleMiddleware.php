<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Jika sudah login tetapi role tidak sesuai
        if (!in_array(auth()->user()->role, $roles)) {
            return redirect()->route('monitoring.index');
        }

        return $next($request);
    }
}