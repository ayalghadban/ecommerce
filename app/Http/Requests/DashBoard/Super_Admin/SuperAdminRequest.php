<?php
namespace App\Http\Requests\Super_Admin;

use App\Http\Requests\BaseRequest;

class SuperAdminRequest extends BaseRequest
{
    public function rules() :array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }
}
