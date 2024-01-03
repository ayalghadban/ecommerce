<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CategoryAddRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'is_active' => ['nullable', Rule::in(['true', 'false'])],
            'category_image' => 'required|image|mimes:jpeg,bmp,svg,png|max:10000',
            'translated_fields.1.category_name' => 'required|max:500|min:3|string',
            'translated_fields.2.category_name' => 'required|max:500|min:3|string',
            'parent_id'=> 'nullable' ,
            'level'=> 'required' ,
        ];
    }

}
