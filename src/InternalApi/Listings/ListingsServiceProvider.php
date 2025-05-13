<?php

namespace FeaturedListings\InternalApi\Listings;

use Illuminate\Support\ServiceProvider;

class ListingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->bootForTestingEnvironment();
    }

    public function bootForTestingEnvironment(): void
    {
        if ($this->app->environment('testing') === false) {
        }
    }
}
