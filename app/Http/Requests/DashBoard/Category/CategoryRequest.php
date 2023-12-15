<?php

namespace App\Http\Requests\DashBoard\Category;

use App\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'id' => 'integer|exists:categories,id',
            'name' => 'required|string',
            'image' => 'required|string'
        ];
    }
}
