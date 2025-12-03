<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\Utilisateur;
use App\Models\TypeContenu;

class ContenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Si l'utilisateur est administrateur, afficher tous les contenus
        if (auth()->check() && auth()->user()->isAdmin()) {
            $contenus = Contenu::all();
        } else {
            // Sinon, afficher uniquement les contenus publiés
            $contenus = Contenu::where('statut', 'publié')->get();
        }
        
        return view('contenus.index', compact('contenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        $auteurs = Utilisateur::all(); 
        $type_contenus = TypeContenu::all();
        return view('contenus.create', compact('regions', 'langues', 'auteurs', 'type_contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:10',
            'statut' => 'required|string|max:100',
            'date_creation' => 'required|string|max:100',
            'region_id' => 'required|string|max:100',
            'langue_id' => 'required|string|max:100',
            'auteur_id' => 'required|string|max:100',
            'type_contenu_id' => 'required|string|max:100'
        ]);

        try {
            $contenu = Contenu::create($validated);
            
            return redirect()->route('contenus')
                ->with('success', 'Contenu créé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du contenu: ' . $e->getMessage());
        }
        return redirect()->route('contenus');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $contenu =Contenu::findOrFail($id);
        return view('contenus.show', compact('contenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contenu = Contenu::findOrFail($id);

        // Récupérer les données pour les listes déroulantes
        $regions = Region::all();
        $langues = Langue::all();
        $auteurs = Utilisateur::all(); 
        $type_contenus = TypeContenu::all();
        return view('contenus.edit', compact('contenu', 'regions', 'langues', 'auteurs', 'type_contenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contenu = Contenu::findOrFail($id);
        //dd($request->all());
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',  // Augmentez la taille maximale
            'statut' => 'required|string|max:50',  // Réduisez la taille si nécessaire
            'date_creation' => 'required|date',    // Utilisez date au lieu de string
            'id_region' => 'required|exists:regions,id',  // Vérifie que l'ID existe
            'id_langue' => 'required|exists:langues,id',
            'id_auteur' => 'required|exists:utilisateurs,id',
            'id_type_contenu' => 'required|exists:type_contenus,id'
        ]);

        try {
            $contenu->update($validated);
            
            return redirect()->route('contenus')
                ->with('success', 'Contenu mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du contenu: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contenu =Contenu::findOrFail($id);
        try {
            $contenu->delete();
            
            return redirect()->route('contenus')
                ->with('success', 'Contenu supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression du contenu: ' . $e->getMessage());
        }
        return redirect()->route('contenus');
    }


    public function updateStatus(Request $request, $id)
    {
        $contenu = Contenu::findOrFail($id);
        
        $request->validate([
            'statut' => 'required|in:validé,rejeté,en_attente'
        ]);

        $contenu->update(['statut' => $request->statut]);

        return redirect()->back()
            ->with('success', 'Statut du contenu mis à jour avec succès');
    }
}
