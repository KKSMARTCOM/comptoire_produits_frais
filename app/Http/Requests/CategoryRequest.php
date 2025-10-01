<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'content' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champs est requis',
            'name.min' => 'Le champs ne peur être moins de 3 caractères'
        ];
    }
}
