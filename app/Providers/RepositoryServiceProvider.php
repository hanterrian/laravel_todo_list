<?php

namespace App\Providers;

use App\Interfaces\Repository\TodoListRepositoryInterface;
use App\Repositories\TodoListRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TodoListRepositoryInterface::class, TodoListRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
