<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profileImage' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Forneça um endereço de e-mail válido.',
            'profileImage.image' => 'O arquivo deve ser uma imagem.',
            'profileImage.mimes' => 'A imagem deve ser do tipo: jpg, png, jpeg ou gif.',
            'profileImage.max' => 'A imagem não deve ter mais de 2048 kilobytes.',
        ];
    }
}
