<?php

namespace App\Providers;

use App\Services\HousekeepingSettingsService;
use App\Services\PermissionsService;
use App\Services\WebsiteSettingsService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            WebsiteSettingsService::class,
            fn () => new WebsiteSettingsService()
        );

        $this->app->singleton(
            HousekeepingSettingsService::class,
            fn () => new HousekeepingSettingsService()
        );

        $this->app->singleton(
            PermissionsService::class,
            fn () => new PermissionsService()
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('habbo.core.force_https')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFour();
    }
}
