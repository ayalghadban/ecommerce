<?php

namespace App\Http\Requests\DashBoard\Product;

use App\Http\Requests\BaseRequest;

class TranslationProductRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'local' => 'required|string|max:2',
        ];
    }
}
