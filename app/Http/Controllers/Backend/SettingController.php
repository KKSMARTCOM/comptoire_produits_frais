<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
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
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Vous devez entrer une adresse email valide',
            'password.confirmed' => 'Vous devez confirmer avec le même mot de passe',
            'old_password.required_with' => 'Vous devez entrez l\'ancien mot de passe pour changer le mot de passe',
        ]);

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
                ]
            );

            $userAuth = Auth::user();
            $role = $userAuth->role == '0' || '1' ? 'Administrateur' : 'Utilisateur';

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

    public function logs()
    {
        // Récupérer les activités avec le causer (l'utilisateur qui a causé l'action)
        $activities = Activity::with('causer')->latest()->paginate(10);

        // Retourner la vue avec les activités
        return view('backend.pages.setting.logs', compact('activities'));
    }
}
