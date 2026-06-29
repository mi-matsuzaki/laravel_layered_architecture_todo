<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentTodoRepository;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TodoRepositoryInterface::class, EloquentTodoRepository::class);
    }

    public function boot(): void {}
}
