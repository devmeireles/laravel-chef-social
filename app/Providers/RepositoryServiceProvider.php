<?php

namespace App\Providers;

use App\Interfaces\CuisineInterface;
use App\Interfaces\IncludesInterface;
use App\Repositories\CuisineRepository;
use App\Repositories\IncludesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CuisineInterface::class, CuisineRepository::class);
        $this->app->bind(IncludesInterface::class, IncludesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}