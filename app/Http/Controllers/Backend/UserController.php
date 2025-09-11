<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    // Afficher la liste des utilisateurs  (index)
    public function index()
    {
        $users = User::where('email', '!=', 'superadmin@gmail.com')->orderBy('id', 'desc')->paginate(10); // Récupérer tous les utilisateurs
        return view('backend.pages.user.index', compact('users')); // Assurez-vous que le chemin de la vue est correct
    }



    // Afficher le formulaire de création (create)
    public function create()
    {
        return view('backend.pages.user.create');
    }

    // Enregistrer un nouvel utilisateur (store)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => [
                "required",
                "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&#^_;:,])[A-Za-z\d@$!%*?&#^_;:,]{6,}$/",
            ],
            'is_admin' => 'required|integer', // Ajoutez une validation pour le rôle
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ], [
            'name.required' => 'Le champs nom d\'utilisateur est obligatoire',
            'email.required' => 'Le champs email est obligatoire',
            'email.unique' => 'Cet email existe déjà',
            'password.required' => 'Le champs mot de passe est obligatoire',
            'password.regex' => 'Le mot de passe doit contenir au moins 6 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.',
            'avatar.image' => 'Le champs photo de profil doit contenir une image',
        ]);

        if ($request->hasFile('avatar')) {
            $img = $request->file('avatar');
            $folderName = $request->name;
            $uploadFolder = 'img/avatar/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->is_admin;
        $user->avatar = $imgurl ?? null;

        $user->save();

        // Vérifiez et attribuez le bon rôle
        if ($request->input('is_admin') == 0) {
            $user->assignRole('admin'); // Administrateur
        } else {
            $user->assignRole('utilisateur'); // Utilisateur simple
        }

        $userAuth = Auth::user();
        $role = $userAuth->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        if ($userAuth && $userAuth->email == 'superadmin@gmail.com') {
            // Si c'est un super admin, ne pas enregistrer l'activité
            return redirect()->route('panel.user.index')->with('success', 'Utilisateur créé avec succès.');
        }


        // Enregistrer l'action de création d'un utilisateur
        activity()
            ->causedBy($userAuth)
            ->performedOn($user)
            ->withProperties(['menu' => 'Utilisateurs', 'action' => 'Création'])
            ->log("{$userAuth->name} ({$role}) a créé un utilisateur : {$user->name}.");


        return redirect()->route('panel.user.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher un utilisateur spécifique (show)
    public function show($id)
    {
        $user = User::where('id', $id)->first(); // Récupérer l'utilisateur avec l'ID spécifié
        return view('backend.pages.user.show', compact('users'));
    }

    // Afficher le formulaire d'édition (edit)
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'superadmin');
        return view('backend.pages.user.edit', compact('user', 'roles'));
    }

    // Mettre à jour un utilisateur (update)
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => [
                "sometimes",
                "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&#^_;:,])[A-Za-z\d@$!%*?&#^_;:,]{6,}$/"
            ],
            'is_admin' => 'required|integer', // Validez également le rôle ici
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->is_admin = $request->is_admin;

        // Récupérer le rôle actuel de l'utilisateur
        $currentRole = $user->roles()->first();
        //dd($currentRole);

        // Vérifiez et mettez à jour le bon rôle
        if ($currentRole && $currentRole->name != 'admin') {
            $user->roles()->detach($currentRole->id);
            $user->assignRole('admin'); // Super Administrateur
        } elseif ($currentRole->name != 'utilisateur') {
            $user->roles()->detach($currentRole->id);
            $user->assignRole('utilisateur'); // Utilisateur simple
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        /* if ($request->hasFile('avatar')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->avatar && file_exists(public_path('images/profiles/' . $user->avatar))) {
                unlink(public_path('images/profiles/' . $user->avatar));
            }

            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('images/profiles'), $imageName);
            $user->avatar = $imageName;
        } */

        $user->save();


        $userAuth = Auth::user();
        $role = $userAuth->is_admin == 0 ? 'Administrateur' : 'Utilisateur';
        //dd($role);


        // Enregistrer l'action de mise à jour d'un utilisateur
        activity()
            ->causedBy($userAuth)
            ->performedOn($user)
            ->withProperties(['menu' => 'Utilisateurs', 'action' => 'Mise à jour'])
            ->log("{$userAuth->name} ({$role}) a mis à jour l'utilisateur : {$user->name}.");

        return redirect()->route('panel.user.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Supprimer un utilisateur (destroy)
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();


        $userAuth = Auth::user();
        $role = $userAuth->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

        // Enregistrer l'action de suppression d'un utilisateur
        activity()
            ->causedBy($userAuth)
            ->performedOn($user)
            ->withProperties(['menu' => 'Utilisateurs', 'action' => 'Suppression'])
            ->log("{$userAuth->name} ({$role}) a supprimé l'utilisateur : {$user->name}.");

        return redirect()->route('panel.user.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
