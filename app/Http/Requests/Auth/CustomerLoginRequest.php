<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required|string|exists:users,phone|regex:/(^(\+)*(\d+)$)/u|max:255|min:6',
            'password' => 'required|string|max:255|min:8',
        ];
    }
}
