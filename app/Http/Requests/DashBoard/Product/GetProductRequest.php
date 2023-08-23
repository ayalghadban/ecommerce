<?php

namespace App\Http\Requests\DashBoard\Product;

use App\Http\Requests\BaseRequest;

class GetProductRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id'
        ];
    }
}
