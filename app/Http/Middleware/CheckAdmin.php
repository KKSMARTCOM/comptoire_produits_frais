<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($role === 'admin' && !$user->isAdmin()) {
                return redirect('/'); // ou une autre route si l'utilisateur n'a pas les permissions
            }

            if ($role === 'superadmin' && !$user->isSuperAdmin()) {
                return redirect('/'); // ou une autre route si l'utilisateur n'a pas les permissions
            }

            return $next($request);
        }

        return redirect('/login'); // Rediriger vers la page de connexion si non authentifié
    }
}