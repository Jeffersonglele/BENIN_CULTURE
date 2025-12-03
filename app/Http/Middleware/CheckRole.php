<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;  // Ajoutez cette ligne

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Vérifiez si l'utilisateur a un rôle et si ce rôle est dans la liste des rôles autorisés
        if ($user->role && in_array($user->role->nom_role, $roles)) {
            return $next($request);
        }

        return redirect('dashboard')->with('error', 'Accès non autorisé.');
    }
}