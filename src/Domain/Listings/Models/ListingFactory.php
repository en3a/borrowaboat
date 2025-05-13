<?php

namespace FeaturedListings\Domain\Listings\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(12),
            'price' => $this->faker->numberBetween(100, 1000),
            'location' => $this->faker->city,
            'usp' => $this->faker->sentence(10),
            'is_trending' => $this->faker->boolean,
        ];
    }
}
