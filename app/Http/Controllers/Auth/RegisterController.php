<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:utilisateurs,email'],
            'date_naissance' => ['required', 'date', 'before:today'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'date_naissance.before' => 'La date de naissance doit être antérieure à aujourd\'hui.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);
    }

    public function register(Request $request)
    {
        \Log::info('=== DÉBUT DU TRAITEMENT DU FORMULAIRE D\'INSCRIPTION ===');
        \Log::info('Données du formulaire reçues :', $request->all());
        
        // Vérifier si le jeton CSRF est valide
        if (! $request->hasValidSignature()) {
            \Log::error('Échec de la validation du jeton CSRF');
            return back()->with('error', 'La session a expiré. Veuillez rafraîchir la page et réessayer.');
        }
        \Log::info('Jeton CSRF valide');

        try {
            // Valider les données
            \Log::info('Validation des données...');
            $validator = $this->validator($request->all());
            
            if ($validator->fails()) {
                \Log::error('Échec de la validation', ['errors' => $validator->errors()->toArray()]);
                return back()->withErrors($validator)->withInput();
            }
            
            $validated = $validator->validated();
            \Log::info('Validation réussie', $validated);

            // Créer l'utilisateur
            \Log::info('Tentative de création de l\'utilisateur...');
            $user = $this->create($validated);
            \Log::info('Résultat de la création', ['user' => $user ? $user->toArray() : null]);

            if (!$user) {
                \Log::error('Échec de la création de l\'utilisateur - La méthode create a retourné null');
                return back()->with('error', 'Échec de la création du compte. Veuillez réessayer.');
            }

            // Connecter l'utilisateur
            \Log::info('Tentative de connexion de l\'utilisateur...');
            auth()->login($user);
            \Log::info('Utilisateur connecté avec succès', ['user_id' => $user->id]);

            // Récupérer le nom du rôle pour le message
            $role = $user->role ? $user->role->nom_role : 'utilisateur';
            \Log::info('Rôle récupéré', ['role' => $role]);

            // Rediriger vers le tableau de bord avec un message de succès
            \Log::info('Redirection vers le tableau de bord...');
            return redirect()->route('dashboard')
                ->with('success', "Inscription réussie ! Vous êtes connecté en tant que $role.");

        } catch (\Exception $e) {
            \Log::error('ERREUR LORS DE L\'INSCRIPTION', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'inscription : ' . $e->getMessage());
        }
    }

    protected function create(array $data)
    {
        \Log::info('Début de la création de l\'utilisateur', $data);

        try {
            // Récupérer le rôle 'auteur' par défaut
            $role = DB::table('roles')->where('nom_role', 'auteur')->first();
            \Log::info('Rôle récupéré', ['role' => $role]);

            if (!$role) {
                \Log::error('Le rôle "auteur" n\'existe pas dans la base de données');
                throw new \Exception('Le rôle par défaut n\'existe pas');
            }

            // Hasher le mot de passe
            $hashedPassword = Hash::make($data['password']);
            \Log::info('Mot de passe hashé', ['hash' => $hashedPassword]);

            // Préparer les données pour l'insertion
            $userData = [
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'password' => $hashedPassword,
                'mot_de_passe' => $hashedPassword, // Pour la rétrocompatibilité
                'date_naissance' => $data['date_naissance'],
                'date_inscription' => now(),
                'statut' => 'actif',
                'photo' => 'default.jpg',
                'id_role' => $role->id,
                'id_langue' => 1, // Langue par défaut
                'created_at' => now(),
                'updated_at' => now(),
            ];

            \Log::info('Tentative d\'insertion dans la base de données', $userData);

            // Insérer l'utilisateur directement avec les mots de passe déjà hashés
            $userId = DB::table('utilisateurs')->insertGetId($userData);
            
            if ($userId) {
                $user = DB::table('utilisateurs')->find($userId);
                \Log::info('Utilisateur créé avec succès', [
                    'id' => $user->id,
                    'email' => $user->email
                ]);
                
                // Retourner une instance du modèle Utilisateur
                return \App\Models\Utilisateur::find($userId);
            } else {
                throw new \Exception('Échec de l\'insertion dans la base de données');
            }

        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de l\'utilisateur: ' . $e->getMessage(), [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
