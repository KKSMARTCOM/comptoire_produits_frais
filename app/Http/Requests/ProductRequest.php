<?php

namespace App\Http\Requests;

use App\Models\Category;
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
            'status' => 'required|in:0,1,2',
            'category_id' => 'required',
            'type' => [
                'sometimes', // Permet d'accepter null sauf si c'est "La Cave"
                function ($attribute, $value, $fail) {
                    $category_id = $this->input('category_id');
                    $category = Category::find($category_id);

                    if ($category && $category->name === 'La Cave' && !$value) {
                        $fail('Le type est obligatoire pour les produits de la catégorie "La Cave".');
                    }
                }
            ],
            'region' => [
                'sometimes', // Permet d'accepter null sauf si c'est "La Cave"
                function ($attribute, $value, $fail) {
                    $category_id = $this->input('category_id');
                    $category = Category::find($category_id);

                    if ($category && $category->name === 'La Cave' && !$value) {
                        $fail('La région est obligatoire pour les produits de la catégorie "La Cave".');
                    }
                }
            ],
            'quantity' => [
                'sometimes',
                function ($attribute, $value, $fail) {

                    $status = $this->input('status');

                    if ($status === '1' && (!$value || $value <= 0)) {
                        $fail('La quantité est obligatoire lorsque le produit est en stock.');
                    }

                    if ($status == '0' && $value) {
                        $fail('La quantité ne doit pas être renseignée pour un produit illimité.');
                    }

                    if ($status == '2' && $value) {
                        $fail('La quantité ne doit pas être renseignée pour un produit épuisé.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champs nom est requis',
            'image.required' => 'L\'image est requise',
            'image.max' => 'La taille de l\'image ne doit pas dépassée 5Mo',
            'price.required' => 'Le champs prix est requis',
            'category_id.required' => 'Le champs catégorie est requis',
            'name.min' => 'Le nom du produit doit être au moins de 3 caractères',
            'price.integer' => 'Le prix du produit doit être un nombre',
            'quantity.integer' => 'La quantité du produit doit être un nombre',
            'quantity.min' => 'La quantité du produit doit être supérieure à 0',

        ];
    }
}
