<?php

namespace App\Http\Requests\DashBoard\User;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required||string|min:2|max:30',
            'phone' => 'required|string|min:2|max:10',
            'password' => 'required|string|min:6',
        ];
    }
}
