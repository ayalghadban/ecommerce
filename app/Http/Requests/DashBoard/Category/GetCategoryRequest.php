<?php

namespace App\Http\Requests\DashBoard\Category;

use App\Http\Requests\BaseRequest;

class GetCategoryRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'category_id' =>'required|integer|exists:categories,id'
        ];
    }
}
