<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\TaskRepositoryInterface;
use App\Contracts\TaskServiceInterface;
use App\Repositories\EloquentTaskRepository;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, EloquentTaskRepository::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
    }

    public function boot(): void
    {
        //
    }
}
