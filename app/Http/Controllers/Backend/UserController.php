<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    // Afficher la liste des utilisateurs  (index)
    public function index()
    {
        $users = User::where('email', '!=', 'superadmin@gmail.com')->get(); // Récupérer tous les utilisateurs
        return view('backend.pages.user.index', compact('users')); // Assurez-vous que le chemin de la vue est correct
    }



    // Afficher le formulaire de création (create)
    public function create()
    {
        //$roles = Role::were('name', '=!', 'superadmin');
        return view('backend.pages.user.create');
    }

    // Enregistrer un nouvel utilisateur (store)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'is_admin' => 'required|integer', // Ajoutez une validation pour le rôle
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);


        $user->save();
        // Vérifiez et attribuez le bon rôle
        if ($request->input('is_admin') == 0) {
            $user->assignRole('admin'); // Administrateur
        } else {
            $user->assignRole('utilisateur'); // Utilisateur simple
        }

        return redirect()->route('panel.user.index')->with('success', 'Utilisateur créé avec succès.');
    }
    /* public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->input('is_admin');

        $user->save();

        return redirect()->route('panel.user.index')->with('success', 'Utilisateur créé avec succès.');

    } */

    // Afficher un utilisateur spécifique (show)
    /* public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    } */
    public function show($id)
    {
        $user = User::where('id', $id)->first(); // Récupérer l'utilisateur avec l'ID spécifié
        return view('backend.pages.user.show', compact('users'));
    }

    // Afficher le formulaire d'édition (edit)
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.pages.user.edit', compact('user'));
    }

    // Mettre à jour un utilisateur (update)
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'is_admin' => 'required|integer', // Validez également le rôle ici
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;

        try {
            //code...
            // Vérifiez et mettez à jour le bon rôle
            if ($request->input('is_admin') == 0) {
                $user->is_admin = 0;
                $user->assignRole('admin'); // Super Administrateur
            } else {
                $user->is_admin = 1;
                $user->assignRole('utilisateur'); // Utilisateur simple
            }

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->route('panel.user.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }
    /* public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->input('is_admin');


        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('panel.user.index')->with('success', 'Utilisateur mis à jour avec succès.');

    } */

    // Supprimer un utilisateur (destroy)
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('panel.user.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
