<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        if ($user->status != '1') { // Assure-toi que 'is_active' est le nom de la colonne pour le statut de l'utilisateur
            Auth::logout(); // Déconnecte l'utilisateur
            return redirect('/login')->with('error', 'Votre compte est inactif. Veuillez contacter l\'administrateur.');
        }

        // Redirige vers la page prévue après la connexion
        return redirect()->intended($this->redirectTo); // ou une autre route par défaut
    }

    // Méthode de déconnexion personnalisée
    public function logout(Request $request)
    {
        Auth::logout();

        // Rediriger vers la page de connexion après la déconnexion
        return redirect('/login');
    }
}
