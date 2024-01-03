<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;


class CategoryGetRequest extends BaseRequest
{
    
    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

   
}
