<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Afficher le formulaire de profil de l'auteur
     */
    public function edit(Request $request): View
    {
        return view('author.profile', [
            'user' => $request->user('utilisateur'),
        ]);
    }

    /**
     * Mettre à jour les informations du profil de l'auteur
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('utilisateur')->fill($request->validated());

        if ($request->user('utilisateur')->isDirty('email')) {
            $request->user('utilisateur')->email_verified_at = null;
        }

        $request->user('utilisateur')->save();

        return Redirect::route('author.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Supprimer le compte de l'auteur
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password:auteur'],
        ]);

        $user = $request->user('utilisateur');

        Auth::guard('utilisateur')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

        /**
     * Mettre à jour le mot de passe de l'utilisateur
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password:utilisateur'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user('utilisateur');
        
        // Vérifier l'ancien mot de passe
        if (!Hash::check($request->current_password, $user->mot_de_passe)) {
            throw ValidationException::withMessages([
                'current_password' => [__('Le mot de passe actuel est incorrect.')],
            ]);
        }

        // Mettre à jour le mot de passe
        $user->update([
            'mot_de_passe' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
