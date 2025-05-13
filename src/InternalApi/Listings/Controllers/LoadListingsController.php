<?php

namespace FeaturedListings\InternalApi\Listings\Controllers;

use App\Http\Controllers\Controller;
use FeaturedListings\Domain\Listings\Models\Listing;
use FeaturedListings\InternalApi\Listings\Requests\LoadListingsRequest;
use FeaturedListings\InternalApi\Listings\Resources\ListingResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LoadListingsController extends Controller
{
    public function __invoke(LoadListingsRequest $request): AnonymousResourceCollection
    {
        $query = Listing::query();

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $listings = $query
            ->orderBy('is_trending', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return ListingResource::collection($listings);
    }
}
