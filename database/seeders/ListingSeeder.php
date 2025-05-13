<?php

namespace Database\Seeders;

use FeaturedListings\Domain\Listings\Models\Listing;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Listing::query()->create([
            'title' => 'Luxury Yacht 3000',
            'location' => 'Miami',
            'price' => 500000,
            'usp' => 'Best for island hopping',
            'is_trending' => true,
        ]);

        Listing::query()->create([
            'title' => 'Family Cruiser',
            'location' => 'Los Angeles',
            'price' => 200000,
            'usp' => 'Perfect for families',
            'is_trending' => false,
        ]);

        Listing::query()->create([
            'title' => 'Speed Demon',
            'location' => 'New York',
            'price' => 350000,
            'usp' => 'Fastest boat in its class',
            'is_trending' => false,
        ]);

        Listing::query()->create([
            'title' => 'Eco Sailor',
            'location' => 'Seattle',
            'price' => 120000,
            'usp' => 'Eco-friendly sailing',
            'is_trending' => false,
        ]);

        Listing::query()->create([
            'title' => 'Party Barge',
            'location' => 'Chicago',
            'price' => 220000,
            'usp' => 'Perfect for events',
            'is_trending' => false,
        ]);
    }
}
