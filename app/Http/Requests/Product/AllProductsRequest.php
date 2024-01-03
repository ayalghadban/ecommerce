<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class AllProductsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'search' => 'nullable',
            'per_page' => 'nullable|integer|max:50|min:1',
            'filter_category_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}
