<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // ⚡ Gate access-admin untuk admin & minor_admin
        Gate::define('access-admin', function (User $user) {
            return in_array($user->jenisUser, ['admin', 'minor_admin']);
        });
    }
}
