<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\BaseRequest;

class SearchProductsRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'search_keyword' => 'required|string|max:255|min:2',
        ];
    }
}
