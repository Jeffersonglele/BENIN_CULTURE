<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langues = \App\Models\Langue::all();
        return view('langues.index', compact('langues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('langues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $validated = $request->validate([
            'code_langue' => 'required|string|max:5|unique:langues,code_langue',
            'nom_langue' => 'required|string|max:10',
            'description' => 'nullable|string'
        ]);

        try {
            // 2. Création de la langue
            $langue = new \App\Models\Langue();
            $langue->code_langue = $validated['code_langue'];
            $langue->nom_langue = $validated['nom_langue'];
            $langue->description = $validated['description'] ?? ''; // Valeur par défaut vide
            $langue->save();

            // 3. Redirection avec message de succès
            return redirect()->route('langues')
                ->with('success', 'Langue créée avec succès');
                
        } catch (\Exception $e) {
            // En cas d'erreur, redirection avec message d'erreur
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de la langue: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $langue = \App\Models\Langue::findOrFail($id);
        return view('langues.show', compact('langue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $langue = \App\Models\Langue::findOrFail($id);
        return view('langues.edit', compact('langue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $langue = \App\Models\Langue::findOrFail($id);
        
        $validated = $request->validate([
            'code_langue' => 'required|string|max:10|unique:langues,code_langue,' . $id,
            'nom_langue' => 'required|string|max:100'
        ]);

        try {
            $langue->update($validated);
            
            return redirect()->route('langues')
                ->with('success', 'Langue mise à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour de la langue: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $langue = \App\Models\Langue::findOrFail($id);
        
        try {
            $langue->delete();
            
            return redirect()->route('langues.index')
                ->with('success', 'Langue supprimée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression de la langue: ' . $e->getMessage());
        }
    }
}


