<?php

namespace FeaturedListings\Domain\Listings;

use Illuminate\Support\ServiceProvider;

class ListingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/DatabaseMigrations');
    }
}
