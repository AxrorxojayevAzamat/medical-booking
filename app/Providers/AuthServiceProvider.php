<?php

namespace App\Providers;

use App\Entity\User\User;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();

        //
    }

    public function registerPostPolicies()
    {
        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-own-profile', function (User $user, User $profile) {
            return $user->isAdmin() || $user->id === $profile->id;
        });

        Gate::define('manage-doctor', function (User $user) {
            return $user->isAdmin() || $user->isDoctor();
        });
    }
}
