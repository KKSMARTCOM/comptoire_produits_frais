<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;


class PromotionController extends Controller
{
    // Afficher la liste des promotions
    public function index()
    {
        $promotions = Promotion::all();
        $categories = Category::all();
        $products = Product::all();
        return view('backend.pages.promotion.index', compact('promotions', 'categories', 'products'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('backend.pages.promotion.create', compact('categories', 'products'));
    }

    // Stocker une nouvelle promotion
    public function store(Request $request)
{
    $request->validate([
        'pourcentage_reduction' => 'required|numeric|min:0|max:100',
        'codePromo' => 'nullable|string|unique:promotions,codePromo', // Le code promo est optionnel
        'category_id' => 'required|exists:categories,id',
        'product_id' => 'required|exists:products,id',
    ]);

    $promotion = new Promotion;
    $promotion->pourcentage_reduction = $request->pourcentage_reduction;
    // Si l'utilisateur fournit un code promo, on l'utilise, sinon on le génère
    $promotion->codePromo = $request->codePromo ?: 'CPFPROMO-' . strtoupper(Str::random(8));
    $promotion->category_id = $request->category_id; // Lier à la catégorie
    $promotion->product_id = $request->product_id;   // Lier au produit
    $promotion->save();

    return redirect()->route('panel.promotions.index')->with('success', 'Promotion créée avec succès.');
}





    // Afficher le formulaire d'édition
    public function edit(Promotion $promotion)
    {
        $categories = Category::all();
        $products = Product::all();
        return view('backend.pages.promotion.edit', compact('promotion', 'categories', 'products'));
    }

    // Mettre à jour une promotion
    public function update(Request $request, Promotion $promotion)
{
    $request->validate([
        'pourcentage_reduction' => 'required|numeric|min:0|max:100',
        'codePromo' => 'nullable|string|unique:promotions,codePromo,' . $promotion->id,
        'category_id' => 'required|exists:categories,id',
        'product_id' => 'required|exists:products,id',
    ]);

    $promotion->update([
        'pourcentage_reduction' => $request->pourcentage_reduction,
        'codePromo' => $request->codePromo ?: $promotion->codePromo,
        'category_id' => $request->category_id, // Mise à jour de la catégorie
        'product_id' => $request->product_id,   // Mise à jour du produit
    ]);

    return redirect()->route('promotions.index')->with('success', 'Promotion mise à jour avec succès.');
}




    // Supprimer une promotion
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('panel.promotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}
