<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class AuthorLoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion pour les auteurs
     */
    public function showLoginForm(): View
    {
        return view('author.auth.login');
    }

    /**
     * Gérer une tentative de connexion d'auteur
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('utilisateur')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('utilisateur')->user();
            
            // Vérifier si l'utilisateur a le rôle 'Auteur' via la relation
            if ($user->role->nom_role !== 'Auteur') {
                Auth::guard('utilisateur')->logout();
                return back()->withErrors([
                    'email' => 'Accès non autorisé avec ce rôle. Seuls les auteurs peuvent se connecter ici.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            
            // Enregistrer l'historique de connexion pour l'auteur
            LoginHistory::create([
                'user_id' => $user->id,
                'user_type' => 'App\\Models\\Utilisateur', // Utilisation du modèle Utilisateur pour les auteurs
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now(),
            ]);
            
            // Rediriger vers le tableau de bord des auteurs
            return redirect()->intended(route('author.dashboard'))
                ->with('success', 'Connexion réussie !');
        }
        
        // Si l'authentification échoue
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Déconnexion de l'auteur
     */
    public function logout(Request $request): RedirectResponse
    {
        // Déconnexion de l'utilisateur
        Auth::guard('utilisateur')->logout();
        
        // Invalider la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Rediriger vers la page de connexion des auteurs
        return redirect()->route('author.login');
    }
}
