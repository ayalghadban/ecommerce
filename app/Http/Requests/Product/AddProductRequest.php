<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'product_price' => 'required|numeric|max:10000000|min:1',
            'product_quantity' => 'required|integer|max:10000000|min:1',
            'product_main_image' => 'required|image|mimes:jpeg,bmp,svg,png|max:10000',
            'product_main_image' => 'required|image|mimes:jpeg,bmp,svg,png|max:10000',
            'en_product_name' => 'required|max:500|min:3|string',
            'ar_product_name' => 'required|max:500|min:3|string',
            'en_product_description' => 'required|max:500|min:3|string',
            'ar_product_description' => 'required|max:500|min:3|string',
        ];
    }
}
