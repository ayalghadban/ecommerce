<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateStatusRequest extends BaseRequest
{
   
    public function rules()
    {
        return [
            'new_status' => ['required', Rule::in([true, false])],
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

 
}
