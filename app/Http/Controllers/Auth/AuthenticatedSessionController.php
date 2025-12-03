<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LoginHistory;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Tenter d'abord de s'authentifier en tant qu'admin (table users)
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            
            // Enregistrer l'historique de connexion pour l'administrateur
            LoginHistory::create([
                'user_id' => Auth::id(),
                'user_type' => 'App\\Models\\User', // Utilisation du modèle User pour les administrateurs
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'login_at' => now(),
            ]);
            
            // Rediriger vers la page des statistiques pour les admins
            return redirect()->intended(route('dashboard', absolute: false));
        }
        
        // Si l'authentification en tant qu'admin échoue, essayer avec la table utilisateurs
        if (Auth::guard('utilisateur')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            
            // Enregistrer l'historique de connexion pour l'auteur
            LoginHistory::create([
                'user_id' => Auth::guard('utilisateur')->id(),
                'user_type' => 'App\\Models\\Utilisateur', // Utilisation du modèle Utilisateur pour les auteurs
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'login_at' => now(),
            ]);
            
            // Rediriger vers le tableau de bord pour les utilisateurs normaux
            return redirect()->intended(route('author.dashboard', absolute: false));
        }
        
        // Si l'authentification échoue pour les deux gardes
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Déconnexion de tous les gardes d'authentification
        Auth::guard('web')->logout();
        
        // Invalider la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
