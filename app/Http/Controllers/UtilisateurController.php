<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Role;
use App\Models\Langue;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Vérifier si la table existe
            if (!\Schema::hasTable('utilisateurs')) {
                \Log::error('La table utilisateurs n\'existe pas');
                return view('utilisateurs.index', ['utilisateurs' => collect()])->with('error', 'La table des utilisateurs n\'existe pas');
            }

            // Vérifier s'il y a des utilisateurs
            $count = Utilisateur::count();
            \Log::info("Nombre total d'utilisateurs dans la base de données: " . $count);

            // Charger les utilisateurs avec leurs relations
            $utilisateurs = Utilisateur::with(['role', 'langue'])->get();
            
            // Vérifier les données pour le débogage
            \Log::info('Utilisateurs chargés avec relations : ' . $utilisateurs->count());
            
            if ($utilisateurs->isEmpty()) {
                \Log::warning('Aucun utilisateur trouvé dans la base de données');
                
                // Vérifier si la table des rôles contient des données
                $rolesCount = \App\Models\Role::count();
                \Log::info("Nombre de rôles dans la base de données: " . $rolesCount);
                
                // Vérifier si la table des langues contient des données
                $languesCount = \App\Models\Langue::count();
                \Log::info("Nombre de langues dans la base de données: " . $languesCount);
            } else {
                foreach ($utilisateurs as $utilisateur) {
                    \Log::info(sprintf(
                        'Utilisateur ID: %d, Nom: %s, Email: %s, Role: %s, Langue: %s',
                        $utilisateur->id,
                        $utilisateur->nom . ' ' . $utilisateur->prenom,
                        $utilisateur->email,
                        $utilisateur->role ? $utilisateur->role->nom_role : 'Aucun',
                        $utilisateur->langue ? $utilisateur->langue->nom_langue : 'Aucune'
                    ));
                }
            }
            
            return view('utilisateurs.index', compact('utilisateurs'));
            
        } catch (\Exception $e) {
            \Log::error('Erreur lors du chargement des utilisateurs: ' . $e->getMessage());
            return view('utilisateurs.index', ['utilisateurs' => collect()])
                ->with('error', 'Une erreur est survenue lors du chargement des utilisateurs');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('utilisateurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('utilisateurs.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $langue = \App\Models\Langue::findOrFail($id);
        $utilisateur = \App\Models\Utilisateur::findOrFail($id);
        return view('utilisateurs.show', compact('utilisateur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = \App\Models\Role::all();
        $langues = \App\Models\Langue::all();
        $utilisateur = \App\Models\Utilisateur::findOrFail($id);
        return view('utilisateurs.edit', compact('utilisateur', 'roles', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $utilisateur = \App\Models\Utilisateur::findOrFail($id);
        return view('utilisateurs.edit', compact('utilisateur', 'roles', 'langues'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $utilisateur = \App\Models\Utilisateur::findOrFail($id);
        
        try {
            $utilisateur->delete();
            
            return redirect()->route('utilisateurs')
                ->with('success', 'Utilisateur supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage());
        }
    }
}
