<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /** Manually register policies as an example;
        Laravel 12 auto-discovers them if naming conventions are followed */
        //Gate::policy(User::class, UserPolicy::class);
        //Gate::policy(Requisition::class, RequisitionPolicy::class);

        // Allow superadmin for all abilities
        Gate::before(function (User $user, string $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
    }
}
