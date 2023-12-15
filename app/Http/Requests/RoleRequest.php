<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id'=> 'integer|exists:roles,id',
            'name' => 'required|string'
        ];
    }
}
