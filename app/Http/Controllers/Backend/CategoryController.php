<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('category:id,category_id,name')->paginate(10);

        // Enregistrer l'action de l'utilisateur lors de l'accès à la liste des catégories
        $user = Auth::user();
        $userName = $user->name;
        //$role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->withProperties(['menu' => 'Catégories', 'action' => 'Accès à la liste'])
            ->log("{$userName} a accédé à la liste des catégories.");

        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            //code...
            // Obtenir toutes les catégories principales (sans parent)
            $categories = Category::where('category_id', null)->get();

            return view('backend.pages.category.edit', compact('categories'));
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $category = Category::create([
            'name' => $request->name,
            'content' => $request->content,
            'sub_cat' => $request->sub_cat,
            'category_id' => $request->category_id,
        ]);

        // Enregistrer l'action de l'utilisateur lors de la création
        $user = Auth::user();
        $userName = $user->name;
        //$role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($category)
            ->withProperties(['menu' => 'Catégories', 'action' => 'Création'])
            ->log("{$userName} a créé une catégorie : {$category->name}");

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

        // Enregistrer l'action de l'utilisateur lors de l'accès à l'édition d'une catégorie
        $user = Auth::user();
        $userName = $user->name;
        //$role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($category)
            ->withProperties(['menu' => 'Catégories', 'action' => 'Édition'])
            ->log("{$userName} a accédé à l'édition de la catégorie : {$category->name}");

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

        // Enregistrer l'action de l'utilisateur lors de la mise à jour
        $user = Auth::user();
        $userName = $user->name;
        //$role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($category)
            ->withProperties(['menu' => 'Catégories', 'action' => 'Mise à jour'])
            ->log("{$userName} a mis à jour la catégorie : {$category->name}");

        return redirect()->route('panel.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->firstOrFail();

        // Enregistrer l'action de l'utilisateur lors de la suppression
        $user = Auth::user();
        $userName = $user->name;
        //$role = $user->isSuperAdmin() ? 'Super-Admin' : 'Admin';

        activity()
            ->causedBy($user)
            ->performedOn($category)
            ->withProperties(['menu' => 'Catégories', 'action' => 'Suppression'])
            ->log("{$userName} a supprimé la catégorie : {$category->name}");

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
