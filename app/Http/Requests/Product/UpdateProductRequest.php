<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'product_price' => 'nullable|numeric|max:10000000|min:1',
            'product_quantity' => 'nullable|integer|max:10000000|min:1',
            'product_main_image' => 'nullable|image|mimes:jpeg,bmp,svg,png|max:10000',
            'en_product_name' => 'nullable|max:500|min:3|string',
            'ar_product_name' => 'nullable|max:500|min:3|string',
            'en_product_description' => 'nullable|max:500|min:3|string',
            'ar_product_description' => 'nullable|max:500|min:3|string',
            "is_most_purchase"=>"nullable",
            "is_cheapest"=>"nullable",
            "is_highlight"=>"nullable",
            "is_latest"=>"nullable"
        ];
        
    }
}
