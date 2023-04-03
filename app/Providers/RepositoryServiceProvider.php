<?php

namespace App\Providers;

use App\Interfaces\CuisineInterface;
use App\Repositories\CuisineRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CuisineInterface:: class, CuisineRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
