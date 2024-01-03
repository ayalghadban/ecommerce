<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string|max:255|min:8',
            'new_password' => 'required|string|max:255|min:8',
        ];
    }
}
