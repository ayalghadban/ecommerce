<?php

namespace App\Http\Requests\DashBoard\Category;

use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'local' =>'required|string|max:2',
        ];
    }
}
