<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoryAllGetRequest extends BaseRequest
{
   
  
    public function rules()
    {
        return [
            'level'=> 'required|integer',
            'parent_id'=> 'nullable|integer',
        ];
    }
}
