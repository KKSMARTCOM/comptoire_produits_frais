<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use App\Models\Product;
use Illuminate\Http\Request;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $packs = Pack::orderBy('id', 'desc')->paginate(10);
        return view('backend.pages.pack.index', compact('packs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $products = Product::all();
        return view('backend.pages.pack.edit', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/packs/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);
        }
        //dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'products' => 'required|array',
        ], [
            'name.required' => 'Vous devez remplir obligatoirement le champs',
            'price.required' => 'Vous devez remplir obligatoirement le champs',
            'products.required' => 'Vous devez remplir obligatoirement le champs',
        ]);

        $pack = Pack::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imgurl ?? NULL,
        ]);

        // Attacher les produits au pack avec leur quantité
        /* foreach ($validated['products'] as $key => $productId) {
            $pack->products()->attach($productId, ['quantity' => $validated['quantities'][$key]]);
        } */

        return back()->withSuccess('Ajout éffectué avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(Request $request)
    {

        $update = $request->status;
        //$updateCheck = $update == "false" ? '0' : '1';

        Pack::where('id', $request->id)->update(['status' => $update]);
        return response(['error' => false, 'status' => $update]);
    }
}
