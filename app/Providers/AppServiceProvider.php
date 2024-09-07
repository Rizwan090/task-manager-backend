<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Contracts\Repositories\PermissionRepositoryContract;
use Modules\Core\Repositories\PermissionRepository;
use Modules\User\Contracts\Repositories\UserRepositoryContract;
use Modules\User\Contracts\Services\AccessTokenContract;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\AccessTokenService;
use Modules\User\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the UserRepositoryContract to UserRepository
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);

        // Bind the UserContract to UserService
        $this->app->bind(UserContract::class, UserService::class);

        // Bind the AccessTokenContract to AccessTokenService
        $this->app->bind(AccessTokenContract::class, AccessTokenService::class);
        $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
