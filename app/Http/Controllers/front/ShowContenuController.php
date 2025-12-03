<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contenu;

class ShowContenuController extends Controller
{

    public function index(Request $request)
    {
        $contenus = Contenu::where('statut', 'validé') // Filtre pour n'afficher que les contenus validés
            ->with([
                'typeContenu',
                'medias',
                'commentaires' => function ($q) {
                    $q->with(['utilisateur', 'notes'])
                    ->latest()
                    ->take(2);
                }
            ])
            ->latest() // Trie les contenus du plus récent au plus ancien
            ->paginate(2); // 2 contenus par page

        if ($request->ajax()) {
            return response()->json([
                'html' => view('front.partials.contenu-items', compact('contenus'))->render(),
                'next' => $contenus->nextPageUrl()
            ]);
        }

        return view('front.contenu', compact('contenus'));
    }

    public function voir($id)
    {
        $contenu = Contenu::findOrFail($id);
        return view('contenu.voir', compact('contenu'));
    }
}
