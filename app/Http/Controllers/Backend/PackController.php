<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pack;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action d'accès à la liste des packs
        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Packs', 'action' => 'Accès à la liste'])
            ->log("{$userName} ({$role}) a accédé à la liste des packs.");

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
        try {
            //code...

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

            $user = Auth::user();
            $userName = $user->name;
            $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

            // Enregistrer l'action de création d'un pack
            activity()
                ->causedBy($user)
                ->performedOn($pack)
                ->withProperties(['menu' => 'Packs', 'action' => 'Création'])
                ->log("{$userName} ({$role}) a créé un pack : {$pack->name}.");

            return back()->withSuccess('Ajout éffectué avec succès !');

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

            $user = Auth::user();
            $userName = $user->name;
            $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

            // Enregistrer l'action d'édition d'un pack
            activity()
                ->causedBy($user)
                ->performedOn($pack)
                ->withProperties(['menu' => 'Packs', 'action' => 'Édition'])
                ->log("{$userName} ({$role}) a accédé à la modification du pack : {$pack->name}.");

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

            $user = Auth::user();
            $userName = $user->name;
            $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

            // Enregistrer l'action de mise à jour du pack
            activity()
                ->causedBy($user)
                ->performedOn($pack)
                ->withProperties(['menu' => 'Packs', 'action' => 'Mise à jour'])
                ->log("{$userName} ({$role}) a mis à jour le pack : {$pack->name}.");

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

        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'action de suppression d'un pack
        activity()
            ->causedBy($user)
            ->performedOn($pack)
            ->withProperties(['menu' => 'Packs', 'action' => 'Suppression'])
            ->log("{$userName} ({$role}) a supprimé le pack : {$pack->name}.");

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
