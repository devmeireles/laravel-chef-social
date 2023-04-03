<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\CuisineInterface;
use App\Interfaces\IncludesInterface;
use App\Interfaces\TagInterface;
use App\Interfaces\RequirementInterface;

use App\Repositories\CuisineRepository;
use App\Repositories\IncludesRepository;
use App\Repositories\TagRepository;
use App\Repositories\RequirementRepository;

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
        $this->app->bind(RequirementInterface::class, RequirementRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}