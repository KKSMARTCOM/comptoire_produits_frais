<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        // Enregistrer l'accès au menu
        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Produits'])
            ->log("{$userName} a accédé au menu Produits");

        $products = Product::with('productCategory')->orderBy('id', 'desc')->paginate(10);
        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            //code...
            $categories = Category::where('category_id', null)->get();
            $types = Category::where('sub_cat', 'type')->get();
            $regions = Category::where('sub_cat', 'region')->get();
            return view('backend.pages.product.edit', compact('categories', 'types', 'regions'));
        } catch (\Exception $e) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/product/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);
        }

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'type' => $request->type ?? NULL,
            'region' => $request->region ?? NULL,
            'image' => $imgurl ?? NULL,
        ]);

        // Enregistrer l'action de l'utilisateur lors de la création
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($product)
            ->withProperties(['menu' => 'Produits', 'action' => 'Création'])
            ->log("{$userName} a créé un produit : {$product->name}");

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
        $product = Product::where('id', $id)->first();
        $types = Category::where('sub_cat', 'type')->get();
        $regions = Category::where('sub_cat', 'region')->get();
        $categories = Category::where('category_id', null)->get();
        return view('backend.pages.product.edit', compact('product', 'categories', 'types', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        if ($request->hasFile('image')) {
            deleteFile($product->image);

            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/product/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);
        }

        $product->update([
            'name' => $request->name ?? $product->name,
            'category_id' => $request->category_id ?? $product->category_id,
            'content' => $request->content ?? $product->content,
            'price' => $request->price ?? $product->price,
            'quantity' => $request->quantity,
            'status' => $request->status ?? $product->status,
            'type' => $request->type,
            'region' => $request->region,
            'image' => $imgurl ?? $product->image
        ]);

        // Enregistrer l'action de l'utilisateur lors de la modification
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($product)
            ->withProperties(['menu' => 'Produits', 'action' => 'Modification'])
            ->log("{$userName} a modifié le produit : {$product->name}");

        return back()->withSuccess('Mise à jour éffectuée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $product = Product::where('id', $request->id)->firstOrFail();

        deleteFile($product->image);

        // Enregistrer l'action de l'utilisateur lors de la suppression
        $user = Auth::user();
        $userName = $user->name;
        $role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($product)
            ->withProperties(['menu' => 'Produits', 'action' => 'Suppression'])
            ->log("{$userName} a supprimé le produit : {$product->name}");

        $product->delete();
        return response(['error' => false, 'message' => 'Produit supprimé avec succès.']);
    }

    public function status(Request $request)
    {

        $update = $request->status;
        //$updateCheck = $update == "false" ? '0' : '1';

        Product::where('id', $request->id)->update(['status' => $update]);
        return response(['error' => false, 'status' => $update]);
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
}
