// app/Providers/AppServiceProvider.php
<?php

namespace App\Providers;

use App\Services\DesignSettingsManager;
use App\Services\PortfolioContentManager;
use App\Services\TechStackManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PortfolioContentManager::class);
        $this->app->singleton(DesignSettingsManager::class);
        $this->app->singleton(TechStackManager::class);
    }

    public function boot(): void
    {
        //
    }
}