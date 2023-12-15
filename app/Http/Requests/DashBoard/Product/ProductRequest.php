<?php

namespace App\Http\Requests\DashBoard\Product;

use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'id' => 'integer|exists:products,id',
            'name'=> 'required|string',
            'sub_category_id' => 'integer|exists:sub_categories,id',
            'category_id' => 'integer|exists:categories,id',
            'description' => 'required|string|min:2|max:255',
            'price' => 'required|integer|min:2',
            'image' => 'required|string',
        ];
    }
}
