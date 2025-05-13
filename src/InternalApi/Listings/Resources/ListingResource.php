<?php

namespace FeaturedListings\InternalApi\Listings\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'location' => $this->location,
            'usp' => $this->usp,
            'price' => $this->price,
            'is_trending' => $this->is_trending,
        ];
    }
}
