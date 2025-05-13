<?php

use FeaturedListings\Domain\Listings\Models\Listing;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', fn () => Inertia::render('Dashboard', [
    'listings' => Listing::query()->get()
]))->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
