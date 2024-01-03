<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserCheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return
        [
            'zone_number' => 'required|numeric',
            'lat' => 'required|string',
            'long' => 'required|string',
            'street' => 'nullable|string|max:500|min:3',
            'building_number' => 'nullable|string|max:500|min:1',
        ];
}
}
