<?php

namespace FeaturedListings\InternalApi;

use FeaturedListings\InternalApi\Listings\ListingsServiceProvider;
use Illuminate\Support\ServiceProvider;

class InternalApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->register(ListingsServiceProvider::class);
    }
}
