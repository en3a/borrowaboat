<?php

namespace FeaturedListings\InternalApi\Listings\Controllers;

use AllowDynamicProperties;
use FeaturedListings\Domain\Listings\Models\ListingFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[AllowDynamicProperties] class LoadListingsControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->createTestListings();
    }

    #[Test] public function it_throws_validation_error_when_max_price_is_not_numeric(): void
    {
        $response = $this->getJson(
            route('api.listings.index', [
                'max_price' => 'not_numeric',
            ])
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'max_price' => 'The max price field must be a number.',
        ]);
    }

    #[Test] public function it_displays_5_last_listings_ordered_by_is_trending(): void
    {
        $response = $this->getJson(
            route('api.listings.index')
        );

        $response->assertOk();

        // make sure there are 5 listings
        $response->assertJsonCount(5, 'data');
        // make sure the first listing is the one with is_trending = true
        $response->assertJsonPath('data.0', [
            'id' => $this->listing1->id,
            'title' => $this->listing1->title,
            'location' => $this->listing1->location,
            'usp' => $this->listing1->usp,
            'price' => $this->listing1->price,
            'is_trending' => 1,
        ]);
    }

    #[Test] public function it_filters_listings_based_on_location(): void
    {
        $response = $this->getJson(
            route('api.listings.index', [
                'location' => 'New York',
            ])
        );

        $response->assertOk();

        $response->assertJsonCount(1, 'data');
        // make sure that the first listing is displayed since the location is New York
        $response->assertJsonPath('data.0', [
            'id' => $this->listing1->id,
            'title' => $this->listing1->title,
            'location' => $this->listing1->location,
            'usp' => $this->listing1->usp,
            'price' => $this->listing1->price,
            'is_trending' => 1,
        ]);
    }

    #[Test] public function it_filters_listings_based_on_price(): void
    {
        $response = $this->getJson(
            route('api.listings.index', [
                'max_price' => 400,
            ])
        );

        $response->assertOk();
        $response->assertJsonCount(4, 'data');

        // make sure it displays the listings with price <= 400
        $response->assertJsonFragment(['id' => $this->listing1->id]);
        $response->assertJsonFragment(['id' => $this->listing2->id]);
        $response->assertJsonFragment(['id' => $this->listing3->id]);
        $response->assertJsonFragment(['id' => $this->listing4->id]);
    }

    #[Test] public function it_filters_listings_based_on_price_and_location(): void
    {
        $response = $this->getJson(
            route('api.listings.index', [
                'max_price' => 400,
                'location' => 'Chicago',
            ])
        );

        $response->assertOk();
        $response->assertJsonCount(1, 'data');

        // make sure it displays the listings with price <= 400 and location = Chicago
        $response->assertJsonFragment(['id' => $this->listing3->id]);

        $response = $this->getJson(
            route('api.listings.index', [
                'max_price' => 500,
                'location' => 'Chicago',
            ])
        );

        $response->assertOk();
        $response->assertJsonCount(2, 'data');

        // make sure it displays the listings with price <= 500 and location = Chicago
        $response->assertJsonFragment(['id' => $this->listing3->id]);
        $response->assertJsonFragment(['id' => $this->listing5->id]);
    }

    private function createTestListings(): void
    {
        $this->listing1 = (new ListingFactory())->create([
            'price' => 100,
            'location' => 'New York',
            'is_trending' => true,
        ]);

        $this->listing2 = (new ListingFactory())->create([
            'price' => 200,
            'location' => 'Los Angeles',
            'is_trending' => false,
        ]);

        $this->listing3 = (new ListingFactory())->create([
            'price' => 300,
            'location' => 'Chicago',
            'is_trending' => false,
        ]);

        $this->listing4 = (new ListingFactory())->create([
            'price' => 400,
            'location' => 'Houston',
            'is_trending' => false,
        ]);

        $this->listing5 = (new ListingFactory())->create([
            'price' => 500,
            'location' => 'Chicago',
            'is_trending' => false,
        ]);
    }
}
