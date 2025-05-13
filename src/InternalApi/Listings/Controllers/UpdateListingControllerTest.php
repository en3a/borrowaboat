<?php

namespace FeaturedListings\InternalApi\Listings\Controllers;

use AllowDynamicProperties;
use Database\Factories\UserFactory;
use FeaturedListings\Domain\Listings\Models\ListingFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[AllowDynamicProperties] class UpdateListingControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->admin = (new UserFactory())->create();

        $this->createTestListings();
    }

    #[Test] public function it_does_not_allow_visitors_to_edit_listings(): void
    {
        $response = $this->putJson(
            route('api.listings.update.trending', [
                'listing' => $this->listing1->id,
            ])
        );

        $response->assertStatus(401);
    }

    #[Test] public function it_updates_listing_trending_key(): void
    {
        $this->actingAs($this->admin);

        $this->assertDatabaseHas('listings', [
            'id' => $this->listing1->id,
            'is_trending' => true,
        ]);

        $this->assertDatabaseHas('listings', [
            'id' => $this->listing2->id,
            'is_trending' => false,
        ]);

        $this->putJson(
            route('api.listings.update.trending', [
                'listing' => $this->listing1->id,
                'is_trending' => false,
            ])
        )->assertOk();

        $this->assertDatabaseHas('listings', [
            'id' => $this->listing1->id,
            'is_trending' => false,
        ]);

        $this->putJson(
            route('api.listings.update.trending', [
                'listing' => $this->listing2->id,
                'is_trending' => true,
            ])
        )->assertOk();

        $this->assertDatabaseHas('listings', [
            'id' => $this->listing2->id,
            'is_trending' => true,
        ]);

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
    }
}
