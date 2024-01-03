<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = auth()->user();

        return [
            'full_name' => 'nullable|string|max:255|min:4',
            'email' => 'nullable|email|max:255|min:5|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.$user->id,
        ];
    }
}
