<?php

use FeaturedListings\Domain\Listings\Models\Listing;
use FeaturedListings\InternalApi\Listings\Controllers\LoadListingsController;
use FeaturedListings\InternalApi\Listings\Controllers\UpdateListingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('api/v1/listings')
    ->middleware(['web'])
    ->name('api.listings.')
    ->group(function (): void {
        Route::put('/{listing}/trending', UpdateListingController::class)->name('update.trending')->middleware('auth');
        Route::get('/', LoadListingsController::class)->name('index');
    });

Route::middleware(['web'])
    ->name('listings')
    ->get('/', fn () => Inertia::render('Listings', [
        'authenticated' => auth()->check(),
        'maxPrice' => Listing::query()->max('price'),
        'locations' => Listing::query()->distinct('location')->pluck('location')->toArray(),
    ]));
