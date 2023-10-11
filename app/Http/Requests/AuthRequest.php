<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|max:255',
            'password' => 'required|max:255|min:8',
            'device_name' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório.',
            'email.max' => 'O email deve ter no máximo 255 caracteres.',
            'password.required' => 'A senha é obrigatória.',
            'password.max' => 'A senha deve ter no máximo 255 caracteres.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'device_name.required' => 'O nome do do dispositivo é obrigatório.',
            'device_name.max' => 'O nome do dispositivo deve ter no máx'
        ];
    }
}
