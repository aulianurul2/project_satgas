<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // ⛔ Jangan redirect kalau sudah di dashboard
                if ($user->jenisUser === 'admin' && !$request->is('admin/*')) {
                    return redirect()->route('admin.dashboard');
                }

                if ($user->jenisUser === 'user' && !$request->is('user/*')) {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
