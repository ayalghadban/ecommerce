<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends BaseRequest
{
    
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',

        ];
    }
}
