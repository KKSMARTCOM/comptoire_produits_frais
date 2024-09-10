<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /* public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    } */

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
