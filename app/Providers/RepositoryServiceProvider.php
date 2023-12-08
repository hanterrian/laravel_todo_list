<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Interfaces\Service\AuthServiceInterface;
use App\Interfaces\Service\TaskListServiceInterface;
use App\Repositories\TaskListRepository;
use App\Services\AuthService;
use App\Services\TaskListService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        $this->app->bind(TaskListRepositoryInterface::class, TaskListRepository::class);
        $this->app->bind(TaskListServiceInterface::class, TaskListService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
