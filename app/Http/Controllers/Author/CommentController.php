<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer l'ID de l'auteur connecté
        $auteurId = auth()->id();
        
        // Récupérer les commentaires des contenus de l'auteur
        $commentaires = Commentaire::whereHas('contenu', function($query) use ($auteurId) {
            $query->where('id_auteur', $auteurId);
        })->with(['utilisateur', 'contenu'])->get();
        
        return view('author.commentaires.index', compact('commentaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commentaires = Commentaire::all();
        return view('author.commentaires.create', compact('commentaires'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commentaire = Commentaire::create($request->all());
        return redirect()->route('author.commentaires.index')->with('success', 'Commentaire créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
