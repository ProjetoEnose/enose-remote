<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currentPassword' => 'required|string|min:8',
            'newPassword' => 'required|string|min:8',
            'confirmNewPassword' => 'required|string|min:8|same:newPassword',
        ];
    }

    public function messages()
    {
        return [
            'currentPassword.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'newPassword.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
            'confirmNewPassword.min' => 'A confirmação da senha deve ter no mínimo 8 caracteres.',
            'confirmNewPassword.same' => 'A confirmação da senha não corresponde à nova senha.',
        ];
    }
}
