<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MinorAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah jenisUser adalah 'minor_admin'
        if (Auth::user()->jenisUser !== 'minor_admin') {
            // Arahkan ke dashboard yang sesuai (misal admin jika dia admin utama, atau user jika dia user biasa)
            // Atau berikan respons 403 (Akses Ditolak)
            
            if (Auth::user()->jenisUser === 'admin') {
                return redirect()->route('admin.dashboard'); // Jika ternyata admin utama
            }

            return abort(403, 'Akses Dibatasi. Anda bukan Minor Admin.');
        }

        return $next($request);
    }
}