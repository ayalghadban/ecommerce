<?php

namespace App\Http\Requests\DashBoard\User;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|string|min:2',
            'password' => 'required|string|min:6',
        ];
    }
}
