<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
class SubCategoryRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'id' => 'integer|exists:sub_categories,id',
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'required|string'
        ];
    }
}
