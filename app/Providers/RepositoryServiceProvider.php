<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\CuisineInterface;
use App\Interfaces\IncludesInterface;
use App\Interfaces\TagInterface;

use App\Repositories\CuisineRepository;
use App\Repositories\IncludesRepository;
use App\Repositories\TagRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CuisineInterface::class, CuisineRepository::class);
        $this->app->bind(IncludesInterface::class, IncludesRepository::class);
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