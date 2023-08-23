<?php

namespace App\Http\Requests\DashBoard\Category;

use App\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'image' => 'required|string'
        ];
    }
}
