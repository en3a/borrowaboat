<?php

namespace FeaturedListings\InternalApi\Listings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoadListingsRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }
}
