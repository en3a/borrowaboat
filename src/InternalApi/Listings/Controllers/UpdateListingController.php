<?php

namespace FeaturedListings\InternalApi\Listings\Controllers;

use App\Http\Controllers\Controller;
use FeaturedListings\Domain\Listings\Models\Listing;
use FeaturedListings\InternalApi\Listings\Requests\UpdateListingRequest;
use FeaturedListings\InternalApi\Listings\Resources\ListingResource;

class UpdateListingController extends Controller
{
    public function __invoke(UpdateListingRequest $request, Listing $listing): ListingResource
    {
        $listing->update(['is_trending' => $request->input('is_trending')]);
        $listing->refresh();

        return ListingResource::make($listing);
    }
}
