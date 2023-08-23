<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\BaseRequest;

class RegisterUserRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'phone' => 'required|max:12',
            'password' => 'required|max:255|min:6',
        ];
    }
}
