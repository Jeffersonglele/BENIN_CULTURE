<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeMedia;

class TypeMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_medias=TypeMedia::all();
        return view('type_media.index', compact('type_medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_medias=TypeMedia::all();
        return view('type_media.create', compact('type_medias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type_media = new TypeMedia();
        $type_media->nom_type_media = $request->nom_type_media;
        $type_media->save();
        return redirect()->route('type_media');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type_medias=TypeMedia::find($id);
        return view('type_media.show', compact('type_medias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type_medias=TypeMedia::find($id);
        return view('type_media.edit', compact('type_medias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type_medias=TypeMedia::find($id);
        $type_medias->update($request->all());
        return redirect()->route('type_media.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type_media = \App\Models\TypeMedia::findOrFail($id);
        
        try {
            $type_media->delete();
            
            return redirect()->route('type_media')
                ->with('success', 'Type de media supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression du type de media: ' . $e->getMessage());
        }
    }
}
