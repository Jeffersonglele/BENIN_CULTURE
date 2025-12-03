<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_contenu' => 'required|exists:contenus,id',
            'texte' => 'required|string|min:5|max:1000',
            'note' => 'nullable|integer|min:1|max:5',
        ]);

        $contenu = \App\Models\Contenu::findOrFail($request->id_contenu);
        $user = auth()->user();

        // Vérifier que l'utilisateur n'est pas l'auteur du contenu
        if ($user->id === $contenu->id_auteur) {
            return back()->with('error', 'Vous ne pouvez pas commenter ou noter votre propre contenu.');
        }

        // Vérifier si l'utilisateur a déjà commenté ce contenu
        $existingComment = \App\Models\Commentaire::where('id_auteur', $user->id)
            ->where('id_contenu', $contenu->id)
            ->first();

        if ($existingComment) {
            return back()->with('error', 'Vous avez déjà commenté ce contenu.');
        }

        // Créer le commentaire
        $commentaire = new \App\Models\Commentaire([
            'id_contenu' => $contenu->id,
            'id_auteur' => $user->id,
            'texte' => $request->texte,
            'note' => $request->note,
        ]);

        $commentaire->save();

        // Mettre à jour la note moyenne du contenu
        $moyenne = $contenu->commentaires()->avg('note');
        $contenu->note = round($moyenne, 1);
        $contenu->save();

        return back()->with('success', 'Votre commentaire a été ajouté avec succès !');
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
