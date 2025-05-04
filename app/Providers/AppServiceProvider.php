<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Gate::define('superadmin', function (User $user) {
            return $user->role === 'superadmin';
        });

        Gate::define('admin', function (User $user) {
            return in_array($user->role, ['admin', 'superadmin']);
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });
    }
}
