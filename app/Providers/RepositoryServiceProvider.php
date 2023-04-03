<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\CuisineInterface;
use App\Interfaces\IncludesInterface;
use App\Interfaces\TagInterface;
use App\Interfaces\RequirementInterface;
use App\Interfaces\LanguageInterface;
use App\Interfaces\PerkInterface;

use App\Repositories\CuisineRepository;
use App\Repositories\IncludesRepository;
use App\Repositories\TagRepository;
use App\Repositories\RequirementRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\PerkRepository;

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
        $this->app->bind(LanguageInterface::class, LanguageRepository::class);
        $this->app->bind(PerkInterface::class, PerkRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}