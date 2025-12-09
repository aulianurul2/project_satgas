<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->jenisUser !== $role) {
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
