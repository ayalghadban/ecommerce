<?php
namespace App\Http\Requests\DashBoard;

use App\Http\Requests\BaseRequest;

class AdminRequest extends BaseRequest
{
    public function rules() :array
    {
        return [
            'id' => 'integer|exists:admins,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'phone' => 'string'
        ];
    }
}
