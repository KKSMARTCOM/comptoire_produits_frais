<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    // Afficher la liste des promotions
    public function index()
    {
        // Charger les promotions avec les catégories et produits associés
        $promotions = Promotion::with('category', 'products')->paginate(10);
        $categories = Category::where('category_id', null)->get();
        $products = Product::all();

        return view('backend.pages.promotion.index', compact('promotions', 'categories', 'products'));
    }


    public function getAllProducts()
    {
        // Récupérer tous les produits
        $products = Product::all();
        return response()->json($products);
    }

    public function productsByCategories($categoryId)
    {
        try {
            //code...
            $products = Product::where('category_id', $categoryId)->get();
            //dd($products);
            return response()->json($products);
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    // Afficher le formulaire de création
    public function create()
    {
        $categories = Category::where('category_id', null)->get();
        $products = Product::all(); // Récupérer tous les produits
        return view('backend.pages.promotion.create', compact('categories', 'products'));
    }

    // Stocker une nouvelle promotion
    public function store(Request $request)
    {
        $request->validate([
            'pourcentage_reduction' => 'required|numeric|min:0|max:100',
            'codePromo' => 'nullable|string|unique:promotions,codePromo',
            'category_id' => 'required|exists:categories,id',
            'products' => 'array', // Validation pour un tableau de produits
            'products.*' => 'exists:products,id', // Validation pour chaque produit
        ], [
            'pourcentage_reduction.required' => 'Le champs pourcentage de réduction est requis.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionée doit exister',
        ]);

        $promotion = new Promotion;
        $promotion->pourcentage_reduction = $request->pourcentage_reduction;
        $promotion->codePromo = $request->codePromo ?: 'CPFPROMO-' . strtoupper(Str::random(8));
        $promotion->category_id = $request->category_id; // Assigner la catégorie
        $promotion->save();

        // Attacher les produits à la promotion
        if ($request->products) {
            $promotion->products()->attach($request->products);
        }


        $user = Auth::user();
        $role = $user->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de création d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Création'])
            ->log("{$user->name} ({$role}) a créé une promotion : {$promotion->name}.");

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion créée avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit(Promotion $promotion)
    {
        $categories = Category::where('category_id', null)->get();
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
            'products' => 'array', // Validation pour un tableau de produits
            'products.*' => 'exists:products,id', // Validation pour chaque produit
        ]);

        $promotion->update([
            'pourcentage_reduction' => $request->pourcentage_reduction,
            'codePromo' => $request->codePromo ?: $promotion->codePromo,
            'category_id' => $request->category_id,
        ]);

        // Synchroniser les produits sélectionnés
        $promotion->products()->sync($request->products);


        $user = Auth::user();
        $role = $user->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de mise à jour d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Mise à jour'])
            ->log("{$user->name} ({$role}) a mis à jour la promotion : {$promotion->name}.");

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion mise à jour avec succès.');
    }

    // Supprimer une promotion
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        $user = Auth::user();
        $role = $user->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de suppression d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Suppression'])
            ->log("{$user->name} ({$role}) a supprimé la promotion : {$promotion->name}.");

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}
