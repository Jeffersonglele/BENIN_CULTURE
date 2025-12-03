<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Récupérer tous les commentaires avec leurs relations
    $query = Commentaire::with(['utilisateur', 'contenu'])
        ->orderBy('created_at', 'desc');

    // Si on veut filtrer par note de contenu (optionnel)
    if ($request->has('filter_notes')) {
        $query->whereHas('contenu', function($q) {
            $q->whereBetween('note', [1, 5]);
        });
    }

    $commentaires = $query->get()->map(function($commentaire) {
        // Vérifier si contenu est une chaîne JSON
        if (is_string($commentaire->contenu) && !empty($commentaire->contenu)) {
            $contenu = json_decode($commentaire->contenu, true);
            $commentaire->contenu = is_array($contenu) ? (object)$contenu : $commentaire->contenu;
        }
        return $commentaire;
    });

    // Pour le débogage
    \Log::info('Commentaires chargés', [
        'total' => $commentaires->count(),
        'premier' => $commentaires->first() ? $commentaires->first()->toArray() : null
    ]);

    return view('commentaires.index', compact('commentaires'));
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
        //
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