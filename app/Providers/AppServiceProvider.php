<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\Contracts\Repositories\ProjectRepositoryContract;
use Modules\Admin\Contracts\Services\ProjectContract;
use Modules\Admin\Repositories\ProjectRepository;
use Modules\Admin\Services\ProjectService;
use Modules\Core\Contracts\Repositories\PermissionRepositoryContract;
use Modules\Core\Repositories\PermissionRepository;
use Modules\User\Contracts\Repositories\CommentRepositoryContract;
use Modules\User\Contracts\Repositories\TaskRepositoryContract;
use Modules\User\Contracts\Repositories\UserRepositoryContract;
use Modules\User\Contracts\Services\AccessTokenContract;
use Modules\User\Contracts\Services\CommentContract;
use Modules\User\Contracts\Services\TaskContract;
use Modules\User\Contracts\Services\UserContract;
use Modules\User\Repositories\CommentRepository;
use Modules\User\Repositories\TaskRepository;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\AccessTokenService;
use Modules\User\Services\CommentService;
use Modules\User\Services\TaskService;
use Modules\User\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserContract::class, UserService::class);
        // Bind the AccessTokenContract to AccessTokenService
        $this->app->bind(AccessTokenContract::class, AccessTokenService::class);
        $this->app->bind(PermissionRepositoryContract::class, PermissionRepository::class);
        $this->app->bind(ProjectContract::class, ProjectService::class);
        $this->app->bind(ProjectRepositoryContract::class, ProjectRepository::class);
        $this->app->bind(ProjectContract::class, ProjectService::class);
        $this->app->bind(TaskContract::class, TaskService::class);
        $this->app->bind(TaskRepositoryContract::class, TaskRepository::class);
        $this->app->bind(CommentContract::class, CommentService::class);
        $this->app->bind(CommentRepositoryContract::class, CommentRepository::class);





    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
