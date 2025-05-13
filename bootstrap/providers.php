<?php

use FeaturedListings\Domain\DomainServiceProvider;
use FeaturedListings\InternalApi\InternalApiServiceProvider;

return [
    DomainServiceProvider::class,
    InternalApiServiceProvider::class,
    App\Providers\AppServiceProvider::class,
];
