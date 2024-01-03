<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AllUsersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255|min:3',
            'per_page' => 'nullable|integer|max:50|min:1',
        ];
    }
}
