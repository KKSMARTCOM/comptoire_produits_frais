<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        return view('backend.pages.setting.index', compact('user'));
    }

    public function create() {}

    public function store() {}

    public function edit() {}

    public function update(Request $request)
    {
        //code...
        $user = User::where('email', Auth()->user()->email)->firstOrFail();

        $request->validate([
            'name' => 'required|min:2',
            'email' => ['required', 'email', function ($attribute, $value, $fail) use ($user) {
                // Si l'utilisateur entre un nouvel email
                if ($value !== $user->email) {
                    // Vérification de l'unicité de l'email
                    if (User::where('email', $value)->exists()) {
                        $fail('Cet email est déjà utilisé.');
                    }
                }
            }],
            'old_password' => 'required_with:password',
            'password' => [
                "nullable",
                "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&#^_;:,])[A-Za-z\d@$!%*?&#^_;:,]{6,}$/",
                "confirmed"
            ],
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Vous devez entrer une adresse email valide',
            'password.regex' => 'Le mot de passe doit contenir au moins 6 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.',
            'password.confirmed' => 'Vous devez confirmer avec le même mot de passe',
            'old_password.required_with' => 'Vous devez entrez l\'ancien mot de passe pour changer le mot de passe',
        ]);

        if ($request->hasFile('avatar')) {
            deleteFile(Auth()->user()->avatar);

            $img = $request->file('avatar');
            $folderName = $request->name;
            $uploadFolder = 'img/avatar/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);
        }

        // Vérification de l'ancien mot de passe
        try {
            if ($request->filled('old_password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return back()->withErrors([
                        'old_password' => 'L\'ancien mot de passe est incorrect.'
                    ]);
                }
            }

            //dd($request->all());

            // Si l'ancien mot de passe est correct, et un nouveau mot de passe est fourni, on peut le mettre à jour
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => $imgurl ?? Auth()->user()->avatar,
                ]
            );

            $userAuth = Auth::user();
            $role = $userAuth->is_admin == 0 ? 'Administrateur' : 'Utilisateur';

            // Enregistrer l'action de suppression d'une promotion
            activity()
                ->causedBy($userAuth)/* 
                ->performedOn($user) */
                ->withProperties(['menu' => 'Profil', 'action' => 'Mise à jour'])
                ->log("{$user->name} ({$role}) a modifié son profil.");

            return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
        } catch (\Exception $e) {
            //dd($e);
            //throw $th;
        }
    }

    public function destroy(Request $request) {}

    public function logs(Request $request)
    {
        // Récupère le mois et l'année depuis la requête (par défaut, le mois actuel)
        $month = $request->input('month', 'all');
        $year = $request->input('year', 'all');

        // Recherche par nom d'utilisateur
        $search = $request->input('search');

        // Récupérer les activités avec le causer (l'utilisateur qui a causé l'action)
        $activities = Activity::with('causer')
            // Filtrer par mois et année uniquement si les valeurs ne sont pas 'all'
            ->when($month != 'all' && $year != 'all', function ($query) use ($month, $year) {
                $query->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year);
            })
            // Recherche par nom de l'utilisateur
            ->when($search, function ($query, $search) {
                return $query->whereHas('causer', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            // Trier par la plus récente
            ->latest()
            // Pagination
            ->paginate(15);

        // Retourner la vue avec les activités
        return view('backend.pages.setting.logs', compact('activities', 'month', 'year', 'search'));
    }
}
