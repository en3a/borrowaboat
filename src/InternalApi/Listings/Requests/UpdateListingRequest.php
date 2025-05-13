<?php

namespace FeaturedListings\InternalApi\Listings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_trending' => ['boolean'],
        ];
    }
}
