<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255|min:5',
            'email' => 'nullable|email|unique:users|max:255|min:3|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|string|unique:users|regex:/(^(\+)*(\d+)$)/u|max:255|min:6',
            'password' => 'required|string|max:255|min:8',
        ];
    }
}
