<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    // Afficher la liste des promotions
    public function index()
    {
        $promotions = Promotion::all();
        return view('backend.pages.promotion.index', compact('promotions'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('backend.pages.promotion.create');
    }

    // Stocker une nouvelle promotion
    public function store(Request $request)
    {
        $request->validate([
            'pourcentage_reduction' => 'required|numeric|min:0|max:100',
        ]);

        $promotion = new Promotion;
        $promotion->pourcentage_reduction = $request->pourcentage_reduction;
        $promotion->save();

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion créée avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit(Promotion $promotion)
    {
        return view('backend.pages.promotion.edit', compact('promotion'));
    }

    // Mettre à jour une promotion
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'pourcentage_reduction' => 'required|numeric|min:0|max:100',
        ]);

        $promotion->update([
            'pourcentage_reduction' => $request->pourcentage_reduction,
        ]);

        return redirect()->route('panel.promotions.index')->with('success', 'Promotion mise à jour avec succès.');
    }

    // Supprimer une promotion
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('panel.promotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}
