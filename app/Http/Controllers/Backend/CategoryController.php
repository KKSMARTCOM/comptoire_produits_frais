<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('category:id,category_id,name')->get();
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtenir toutes les catégories principales (sans parent)
        $categories = Category::where('category_id', null)->get();

        return view('backend.pages.category.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        Category::create([
            'name' => $request->name,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return back()->withSuccess('Nouvelle catégorie ajoutée avec succès');
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
        $category = Category::where('id', $id)->first();
        $categories = Category::where('category_id', null)->get();
        return view('backend.pages.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::where('id', $id)->firstOrFail();


        $category->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'content' => $request->content ?? $category->content
        ]);

        return redirect()->route('panel.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->firstOrFail();

        $category->delete();
        return response(['error' => false, 'message' => 'Category deleted successfully']);
    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Category::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error' => false, 'status' => $update]);
    }
}
