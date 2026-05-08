<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Models\Section;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            //code...
            $sections = Section::all();
            $categories = Category::where('category_id', null)->get();
            $types = Category::where('sub_cat', 'type')->get();
            $regions = Category::where('sub_cat', 'region')->get();
            return view('backend.pages.product.edit', compact('categories', 'types', 'regions', 'sections'));
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

        $additionals = null;

        if ($request->hasFile('additionals_images')) {
            $additionals = [];

            foreach ($request->file('additionals_images') as $index => $file) {
                $folderName = $request->name . '-' . $index;
                $uploadFolder = 'img/products/';
                folderOpen($uploadFolder);
                $additionalImgurl = uploadImage($file, $folderName, $uploadFolder);
                $additionals[] = $additionalImgurl;
            }
        }

        $video = null;

        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $folderName = $request->name . '-video';
            $uploadFolder = 'videos/products/';
            folderOpen($uploadFolder);
            $video = uploadVideo($videoFile, $folderName, $uploadFolder);
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
            'additionals_images' => $additionals ? json_encode($additionals) : null,
            'image' => $imgurl ?? NULL,
            'video' => $video ?? NULL,
        ]);

        // Enregistrer l'action de l'utilisateur lors de la création
        $user = Auth::user();
        $role = $user->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        activity()
            ->causedBy($user)
            ->performedOn($product)
            ->withProperties(['menu' => 'Produits', 'action' => 'Création'])
            ->log("{$user->name} ({$role}) a créé un produit : {$product->name}");

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

        $additionals = null;

        if ($request->hasFile('additionals_images')) {

            $oldImages = json_decode($product->additionals_images ?? '[]', true);

            if (is_array($oldImages) && count($oldImages) > 0) {
                foreach ($oldImages as $oldImage) {
                    deleteFile($oldImage);
                }
            }

            $additionals = [];

            foreach ($request->file('additionals_images') as $index => $file) {
                $folderName = $request->name . '-' . $index;
                $uploadFolder = 'img/products/';
                folderOpen($uploadFolder);
                $additionalImgurl = uploadImage($file, $folderName, $uploadFolder);
                $additionals[] = $additionalImgurl;
            }
        }

        $video = $product->video;

        if ($request->hasFile('video')) {
            if ($product->video) {
                deleteFile($product->video);
            }

            $videoFile = $request->file('video');
            $folderName = $request->name . '-video';
            $uploadFolder = 'videos/products/';
            folderOpen($uploadFolder);
            $video = uploadVideo($videoFile, $folderName, $uploadFolder);
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
            'image' => $imgurl ?? $product->image,
            'additionals_images' => $additionals ? json_encode($additionals) : $product->additionals_images,
            'video' => $video,
        ]);

        // Enregistrer l'action de l'utilisateur lors de la modification
        $user = Auth::user();
        $role = $user->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        activity()
            ->causedBy($user)
            ->performedOn($product)
            ->withProperties(['menu' => 'Produits', 'action' => 'Modification'])
            ->log("{$user->name} ({$role}) a modifié le produit : {$product->name}");

        return back()->withSuccess('Mise à jour éffectuée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $product = Product::where('id', $request->id)->firstOrFail();

        deleteFile($product->image);

        if ($product->additionals_images) {
            foreach (json_decode($product->additionals_images) as $file) {
                deleteFile($file);
            }
        }

        if ($product->video) {
            deleteFile($product->video);
        }

        // Enregistrer l'action de l'utilisateur lors de la suppression
        $user = Auth::user();
        $role = $user->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        activity()
            ->causedBy($user)
            ->performedOn($product)
            ->withProperties(['menu' => 'Produits', 'action' => 'Suppression'])
            ->log("{$user->name} ({$role}) a supprimé le produit : {$product->name}");

        $product->delete();
        return response(['error' => false, 'message' => 'Produit supprimé avec succès.']);
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
