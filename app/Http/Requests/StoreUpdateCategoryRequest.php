<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCategoryRequest extends FormRequest
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
        $rules = [
            'name' => 'required|unique:categories,name',
            'description' => 'required',
            'status' => 'required',
        ];

        if ($this->method() === 'PUT') {
            $rules['name'] = [
                'required',
                Rule::unique('categories')->ignore($this->id),
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'Esta categoria já existe.',
            'description' => 'A descrição é obrigatória.',
            'status' => 'O status é obrigatório.',
        ];
    }
}
