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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'email|required',
            'password' => 'required',
            'device_name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'O email deve ser um email válido.',
            'email.required' => 'O email é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'device_name.required' => 'O nome do dispositivo é obrigatório',
        ];
    }
}
