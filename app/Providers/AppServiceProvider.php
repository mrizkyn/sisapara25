<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        Gate::define('superadmin', function (User $user) {
            return $user->role === 'superadmin';
        });

        Gate::define('admin', function (User $user) {
            // return in_array($user->role, ['admin', 'superadmin']);
            return $user->role === 'admin';
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });
    }
}
