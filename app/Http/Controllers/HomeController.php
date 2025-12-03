<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Contenu;
use App\Models\Role;

class HomeController extends Controller
{
   public function index()
    {
        // Récupération des statistiques
        $stats = [
            'utilisateurs' => [
                'total' => \App\Models\Utilisateur::count(),
                'nouveaux_mois' => \App\Models\Utilisateur::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'icon' => 'users',
            ],
            'contenus' => [
                'total' => \App\Models\Contenu::count(),
                'nouveaux_mois' => \App\Models\Contenu::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'icon' => 'file-alt',
            ],
            'langues' => [
                'total' => \App\Models\Langue::count(),
                'icon' => 'language',
            ],
            'regions' => [
                'total' => \App\Models\Region::count(),
                'icon' => 'map-marked-alt',
            ]
        ];

        // Statistiques supplémentaires pour les contenus
        $contenuStats = [
            'total' => \App\Models\Contenu::count(),
            'valides' => \App\Models\Contenu::where('statut', 'valide')->count(),
            'en_attente' => \App\Models\Contenu::where('statut', 'en_attente')->count(),
            'nouveaux_contenus_mois' => \App\Models\Contenu::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count()
        ];

        // Données pour les graphiques (6 derniers mois)
        $months = collect();
        $userData = collect();
        $contentData = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months->push($date->translatedFormat('M Y'));
            
            $userData->push(
                \App\Models\Utilisateur::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            );
            
            $contentData->push(
                \App\Models\Contenu::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count()
            );
        }

        return view('welcome', compact(
            'stats', 
            'contenuStats',  
            'months', 
            'userData', 
            'contentData'
        ));
    }

}