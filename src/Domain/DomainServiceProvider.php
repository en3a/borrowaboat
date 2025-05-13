<?php

namespace FeaturedListings\Domain;

use FeaturedListings\Domain\Listings\ListingsServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->register(ListingsServiceProvider::class);
    }
}
