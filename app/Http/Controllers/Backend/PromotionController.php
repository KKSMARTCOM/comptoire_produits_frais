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

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'accès à la liste des promotions
        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Accès à la liste'])
            ->log("{$userName} ({$role}) a accédé à la liste des promotions.");

        // Charger les promotions avec les catégories et produits associés
        $promotions = Promotion::with('category', 'products')->get();
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

    public function getProductsByCategory($categoryId)
    {
        // Récupérer les produits de la catégorie sélectionnée
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json($products);
    }



    // Afficher le formulaire de création
    public function create()
    {
        /* $categories = Category::all();
        $products = Product::all();
        return view('backend.pages.promotion.create', compact('categories', 'products')); */
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
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de création d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Création'])
            ->log("{$userName} ({$role}) a créé une promotion : {$promotion->name}.");

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion créée avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit(Promotion $promotion)
    {
        $categories = Category::where('category_id', null)->get();
        $products = Product::all();

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'édition d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Édition'])
            ->log("{$userName} ({$role}) a accédé à la modification de la promotion : {$promotion->name}.");

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
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de mise à jour d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Mise à jour'])
            ->log("{$userName} ({$role}) a mis à jour la promotion : {$promotion->name}.");

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion mise à jour avec succès.');
    }

    // Supprimer une promotion
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de suppression d'une promotion
        activity()
            ->causedBy($user)
            ->performedOn($promotion)
            ->withProperties(['menu' => 'Promotions', 'action' => 'Suppression'])
            ->log("{$userName} ({$role}) a supprimé la promotion : {$promotion->name}.");

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}
