<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Repository\TodoListRepositoryInterface;
use App\Interfaces\Service\TodoListServiceInterface;
use App\Repositories\TodoListRepository;
use App\Services\TodoListService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TodoListRepositoryInterface::class, TodoListRepository::class);
        $this->app->bind(TodoListServiceInterface::class, TodoListService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
