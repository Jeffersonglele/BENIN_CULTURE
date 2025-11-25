<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeContenu;

class MediasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = Media::all();
        return view('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeContenus = TypeContenu::all();
        $contenus = Contenu::all();
        return view('medias.create', compact('typeContenus', 'contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_contenu' => 'required|exists:contenus,id',
            'id_type_contenu' => 'required|exists:type_contenus,id',
            'chemin' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        try {
            Media::create($validated);
            return redirect()->route('medias.index')
                ->with('success', 'Média créé avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur lors de la création du média : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Media::with(['contenu', 'typeContenu'])->findOrFail($id);
        return view('medias.show', compact('media'));//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $media = Media::findOrFail($id);
        $typeContenus = TypeContenu::all();
        $contenus = Contenu::all();
        return view('medias.edit', compact('media', 'typeContenus', 'contenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_contenu' => 'required|exists:contenus,id',
            'id_type_contenu' => 'required|exists:type_contenus,id',
        ]);

        $media = Media::findOrFail($id);
        $updated = $media->update($validated);

        if ($updated) {
            \Log::info('Média mis à jour avec succès', ['media_id' => $media->id]);
            return redirect()->route('medias')
                ->with('success', 'Média modifié avec succès.');
        } else {
            \Log::error('Échec de la mise à jour du média', ['media_id' => $id]);
            return back()->with('error', 'Échec de la mise à jour du média');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return view('medias.destroy', compact('id'));//
    }
}
