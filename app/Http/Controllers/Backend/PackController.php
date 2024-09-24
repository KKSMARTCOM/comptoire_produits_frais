<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $categories = Category::all();
        //$products = Product::all();
        return view('backend.pages.pack.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $folderName = $request->name;
                $uploadFolder = 'img/packs/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'product_id' => 'required|array',
                'quantity' => 'required|array',
            ], [
                'name.required' => 'Vous devez remplir obligatoirement le champs.',
                'price.required' => 'Vous devez remplir obligatoirement le champs.',
                'product_id.required' => 'Vous devez choisir un produit.',
                'quantity.required' => 'Vous devez entrer une quantité du produit choisis.',
            ]);
            //dd($validated);

            $pack = Pack::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,
                'image' => $imgurl ?? NULL,
            ]);

            //dd($pack);

            // Attacher les produits au pack avec leur quantité
            foreach ($validated['product_id'] as $key => $productId) {
                $pack->products()->attach($productId, ['quantity' => $validated['quantity'][$key]]);
            }

            return back()->withSuccess('Ajout éffectué avec succès !');
        } catch (\Exception $e) {
            //dd($e);
            //throw $th;
        }
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
        try {
            //code...
            $pack = Pack::where('id', $id)->with('products')->first();
            $categories = Category::all();
            $products = Product::get();
            return view('backend.pages.pack.edit', compact('products', 'categories', 'pack'));
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            $pack = Pack::where('id', $id)->firstOrFail();

            if ($request->hasFile('image')) {
                deleteFile($pack->image);

                $img = $request->file('image');
                $folderName = $request->name;
                $uploadFolder = 'img/packs/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'product_id' => 'required|array',
            ], [
                'name.required' => 'Vous devez remplir obligatoirement le champs 1',
                'price.required' => 'Vous devez remplir obligatoirement le champs 2',
                'product_id.required' => 'Vous devez remplir obligatoirement le champs 3',
            ]);

            // Mettre à jour le pack
            $pack->update([
                'name' => $request->name ?? $pack->name,
                'description' => $request->description ?? $pack->description,
                'price' => $request->price ?? $pack->price,
                'status' => $request->status ?? $pack->status,
                'image' => $imgurl ?? $pack->image,
            ]);

            // Sync des produits avec les nouvelles quantités

            $products = [];
            foreach ($validated['product_id'] as $key => $productId) {
                $products[$productId] = ['quantity' => $request->quantity[$key]];
                /* $pack->products()->attach($productId); */
            }
            $pack->products()->sync($products);

            return back()->withSuccess('Mise à jour éffectuée avec succès !');
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $pack = Pack::where('id', $request->id)->firstOrFail();

        deleteFile($pack->image);

        $pack->delete();

        return response(['error' => false, 'message' => 'Coffret supprimé avec succès !']);
    }

    public function status(Request $request)
    {

        $update = $request->status;
        //$updateCheck = $update == "false" ? '0' : '1';

        Pack::where('id', $request->id)->update(['status' => $update]);
        return response(['error' => false, 'status' => $update]);
    }
}
