<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AuthorRegisterController extends Controller
{
    /**
     * Afficher le formulaire d'inscription pour les auteurs
     */
    public function create(): View
    {
        return view('author.auth.register');
    }

    /**
     * Gérer une demande d'inscription d'auteur
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:utilisateurs,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_naissance' => ['required', 'date', 'before:today'],
        ]);

        // Récupérer l'ID du rôle 'auteur' (généralement 2 ou 3 selon votre base de données)
        $roleId = \App\Models\Role::where('nom_role', 'Auteur')->firstOrFail()->id;

        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->password),
            'date_naissance' => $request->date_naissance,
            'date_inscription' => now(),
            'statut' => 'actif',
            'id_role' => $roleId,
            'id_langue' => 1, // Par défaut, on met la langue 1 (à adapter selon votre logique)
            'photo' => 'default.jpg',
        ]);

        event(new Registered($utilisateur));

        Auth::guard('utilisateur')->login($utilisateur);

        return redirect(route('author.dashboard', absolute: false));
    }
}
