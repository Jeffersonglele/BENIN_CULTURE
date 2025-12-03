<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\Commentaire;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord de l'auteur
     */
    public function index(): View
    {
        $user = auth()->guard('utilisateur')->user();
        if (!$user) {
            return redirect()->route('author.login');
        }
        
        // Compter les contenus publiés par l'auteur
        $contenusPublies = Contenu::where('id_auteur', $user->id)
            ->where('statut')
            ->count();

        // Compter les médias des contenus de l'auteur
        $mediasPublies = Media::whereHas('contenu', function($query) use ($user) {
                $query->where('id_auteur', $user->id)
                      ->where('statut'); 
            })
            ->count();

        // Compter les commentaires sur les contenus de l'auteur
        $commentaires = Commentaire::whereHas('contenu', function($query) use ($user) {
                $query->where('id_auteur', $user->id)
                      ->where('statut');
            })
            ->count();

        // Préparer les données pour le graphique (6 derniers mois)
        $months = collect();
        $contenusData = collect();
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthYear = $date->format('M Y');
            $months->push($monthYear);
            
            $count = Contenu::where('id_auteur', $user->id)
                ->where('statut', 'validé')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $contenusData->push($count);
        }

        // Préparer les statistiques
        $stats = [
            'contenus' => [
                'total' => $contenusPublies,
                'icon' => 'file-alt',
                'class' => 'info',
                'libelle' => 'Contenus publiés'
            ],
            'medias' => [
                'total' => $mediasPublies,
                'icon' => 'image',
                'class' => 'success',
                'libelle' => 'Médias publiés'
            ],
            'commentaires' => [
                'total' => $commentaires,
                'icon' => 'comments',
                'class' => 'warning',
                'libelle' => 'Commentaires reçus'
            ]
        ];

        return view('author.dashboard', [
            'user' => $user,
            'stats' => $stats,
            'months' => $months,
            'contenusData' => $contenusData
        ]);
    }

    /**
     * Afficher le profil de l'auteur
     */
    public function profile(): View
    {
        return view('author.profile', [
            'user' => auth()->guard('auteur')->user(),
        ]);
    }
}