<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\Auteur;
use App\Models\TypeContenu;

class ContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'ID de l'auteur connecté
        $auteurId = Auth::id();
        
        // Récupérer uniquement les contenus de l'auteur connecté
        $regions = Region::all();
        $langues = Langue::all();
        $auteurs = Auteur::all();
        $type_contenus = TypeContenu::all();
        $contenus = Contenu::where('id_auteur', $auteurId)
            ->with(['region', 'langue', 'auteur', 'typeContenu']) // Charger les relations
            ->latest() // Trier par date de création décroissante
            ->get();
            
        return view('author.contenus.index', compact('contenus', 'regions', 'langues', 'auteurs', 'type_contenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        // Récupérer uniquement l'auteur connecté
        $auteur = Auth::guard('utilisateur')->user();
        $type_contenus = TypeContenu::all();
        return view('author.contenus.create', compact('regions', 'langues', 'auteur', 'type_contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'date_creation' => 'required|date',
            'region_id' => 'required|exists:regions,id',
            'langue_id' => 'required|exists:langues,id',
            'auteur_id' => 'required|exists:utilisateurs,id',
            'type_contenu_id' => 'required|exists:type_contenus,id',
        ]);

        // Création du contenu avec les données validées
        $contenu = new Contenu([
            'titre' => $request->titre,
            'texte' => $request->texte,
            'date_creation' => $request->date_creation,
            'id_region' => $request->region_id,
            'id_langue' => $request->langue_id,
            'id_auteur' => $request->auteur_id,
            'id_type_contenu' => $request->type_contenu_id,
            'date_validation' => null, // La date de validation sera définie par un administrateur
            'statut' => 'en-attente',// Statut initial du contenu
            'id_moderateur' => 2 // Définition de l'ID du modérateur par défaut
        ]);
        
        $contenu->save();

        return redirect()->route('author.contenus.index')->with('success', 'Contenu créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contenu = Contenu::findOrFail($id);
        $regions = Region::all();
        $langues = Langue::all();
        $auteurs = Auteur::all();
        $type_contenus = TypeContenu::all();
        return view('author.contenus.show', compact('contenu', 'regions', 'langues', 'auteurs', 'type_contenus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contenu = Contenu::findOrFail($id);
        $regions = Region::all();
        $langues = Langue::all();
        $auteurs = Auteur::all();
        $type_contenus = TypeContenu::all();
        return view('author.contenus.edit', compact('contenu', 'regions', 'langues', 'auteurs', 'type_contenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required',
            'date_creation' => 'required',
            'region_id' => 'required',
            'langue_id' => 'required',
            'auteur_id' => 'required',
            'type_contenu_id' => 'required',
        ]);

        $contenu = Contenu::findOrFail($id);
        $contenu->update([
            'titre' => $request->titre,
            'date_creation' => $request->date_creation,
            'id_region' => $request->region_id,
            'id_langue' => $request->langue_id,
            'id_auteur' => $request->auteur_id,
            'id_type_contenu' => $request->type_contenu_id,
        ]);

        return redirect()->route('author.contenus.index')->with('success', 'Contenu mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contenu = Contenu::findOrFail($id);
        $contenu->delete();

        return redirect()->route('author.contenus.index')->with('success', 'Contenu supprimé avec succès');
    }
}
