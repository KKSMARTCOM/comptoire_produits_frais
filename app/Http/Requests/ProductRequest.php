<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'image' => 'sometimes|required|max:5120',
            'price' => 'required|integer',
            'category_id' => 'required',
            'quantity' => ['required_if:status,1|integer'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champs est requis',
            'image.required' => 'Le champs est requis',
            'image.max' => 'La taille de l\'image ne doit pas dépassée 5Mo',
            'price.required' => 'Le champs est requis',
            'category_id.required' => 'Le champs est requis',
            'quantity.required_if' => 'Le champs est requis',
            'name.min' => 'Le nom du produit doit être au moins de 3 caractères',
            'price.numeric' => 'Le prix du produit doit être un nombre',
            'quantity.numeric' => 'La quantité du produit doit être un nombre',

        ];
    }
}
