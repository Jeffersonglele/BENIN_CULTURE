<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = \App\Models\Region::all();
        return view('region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('region.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation and creation logic would go here
        // For now, just redirect back
        return redirect()->route('regions');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $region = \App\Models\Region::findOrFail($id);
        return view('region.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = \App\Models\Region::findOrFail($id);
        return view('region.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation and update logic would go here
        $region = \App\Models\Region::findOrFail($id);
        
        $validated = $request->validate([
            'nom_region' => 'required|string|max:10|unique:regions,nom_region,' . $id,
            'population' => 'required|string|max:100',
            'superficie' => 'required|string|max:100',
            'localisation' => 'required|string|max:100'
        ]);

        try {
            $region->update($validated);
            
            return redirect()->route('regions')
                ->with('success', 'Region mise à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour de la region: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = \App\Models\Region::findOrFail($id);
        
        try {
            $region->delete();
            
            return redirect()->route('regions')
                ->with('success', 'Region supprimée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression de la region: ' . $e->getMessage());
        }
    }
}
