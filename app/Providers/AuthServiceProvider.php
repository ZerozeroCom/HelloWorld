<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 系統管理者 Gate 規則
        Gate::define('admin', function ($user) {
            return $user->type === User::ROLE_ADMIN;
        });

        // 一般管理者 Gate 規則
        Gate::define('common', function ($user) {

            return $user->type === User::ROLE_COMMON || $user->type === User::ROLE_ADMIN;
        });

    }
}
