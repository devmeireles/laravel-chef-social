<?php

namespace App\Providers;

use App\Interfaces\CuisineInterface;
use App\Interfaces\TagInterface;
use App\Repositories\CuisineRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CuisineInterface::class, CuisineRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}