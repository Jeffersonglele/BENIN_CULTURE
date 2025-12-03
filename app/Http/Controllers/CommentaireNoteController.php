<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\CommentaireNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireNoteController extends Controller
{
    public function store(Commentaire $commentaire, Request $request)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
        ]);

        // Vérifier que l'utilisateur n'est pas l'auteur du commentaire
        if (Auth::id() === $commentaire->id_utilisateur) {
            return response()->json([
                'error' => 'Vous ne pouvez pas noter votre propre commentaire.'
            ], 403);
        }

        // Mettre à jour ou créer la note
        $note = CommentaireNote::updateOrCreate(
            [
                'commentaire_id' => $commentaire->id,
                'user_id' => Auth::id(),
            ],
            ['note' => $request->note]
        );

        return response()->json([
            'success' => true,
            'average_note' => $commentaire->averageNote(),
            'user_note' => $note->note
        ]);
    }
}