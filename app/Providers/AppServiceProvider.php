<?php

namespace App\Providers;

use FeaturedListings\Domain\DomainServiceProvider;
use FeaturedListings\InternalApi\InternalApiServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(DomainServiceProvider::class);
        $this->app->register(InternalApiServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
