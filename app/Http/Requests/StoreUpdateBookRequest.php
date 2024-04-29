<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateBookRequest extends FormRequest
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
            'name' => 'required|unique:books,name',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'author' => 'required',
            'publishingCompany' => 'required',
            'synpose' => 'required',
            'category_id' => 'exists:categories,id'
        ];
    }
}
