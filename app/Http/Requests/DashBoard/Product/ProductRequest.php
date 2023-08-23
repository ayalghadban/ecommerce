<?php

namespace App\Http\Requests\DashBoard\Product;

use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required|string|min:2|max:255',
            'price' => 'required|integer|min:2',
            'image' => 'required|string',
            'is_featured' => 'required|boolean'
        ];
    }
}
