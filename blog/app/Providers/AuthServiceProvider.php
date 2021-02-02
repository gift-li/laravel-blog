<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\User;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class
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
            return $user->role === User::ROLE_ADMIN;
        });
      
        // 一般使用者 Gate 規則
        Gate::define('user', function ($user) {
            return $user->role === User::ROLE_USER;
        });

        // 停權使用者 Gate 規則
        Gate::define('manager', function ($user) {
            return $user->role === User::ROLE_SUSPEND;
        });
    }
}
