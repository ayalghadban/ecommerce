<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\BaseRequest;

class AddProductToCartRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|max:100000|min:0',
        ];
    }
}
