<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeContenu;

class TypeContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_contenus=TypeContenu::all();
        return view('type_contenu.index', compact('type_contenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_contenus=TypeContenu::all();
        return view('type_contenu.create', compact('type_contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('type_contenu.store', compact('type_contenus'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type_contenu=TypeContenu::findOrFail($id);
        return view('type_contenu.show', compact('type_contenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type_contenu=TypeContenu::findOrFail($id);
        return view('type_contenu.edit', compact('type_contenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type_contenu=TypeContenu::findOrFail($id);
        $type_contenu->update($request->all());
        return redirect()->route('type_contenu');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type_contenu = \App\Models\TypeContenu::findOrFail($id);
        
        try {
            $type_contenu->delete();
            
            return redirect()->route('type_contenu')
                ->with('success', 'Type de contenu supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression du type de contenu: ' . $e->getMessage());
        }
    }
}
