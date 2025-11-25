<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commentaires = Commentaire::with('utilisateur')
            ->whereHas('contenu', function($query) {
                $query->whereBetween('note', [3, 5]);
            })
            ->orderBy('note', 'desc') // Du mieux noté au moins bien noté
            ->get()
            ->map(function($commentaire) {
                // Décoder le contenu JSON
                $contenu = json_decode($commentaire->contenu, true);
                $commentaire->contenu = (object) $contenu;
                return $commentaire;
            });

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
