<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // Wajib di-import untuk Gate
use App\Models\User; // Wajib di-import untuk Type Hinting User Model

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mendefinisikan Gate 'access-admin'
        Gate::define('access-admin', function (User $user) {
            // Cek apakah kolom 'role' pada User yang login bernilai 'admin'
            // Ganti 'admin' dengan nilai yang sesuai di database Anda jika berbeda
            return $user->jenisUser === 'admin'; 
        });
    }
}