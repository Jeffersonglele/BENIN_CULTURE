<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Models\Media;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // If user is admin (from users table), redirect to stats
        if ($user->isAdmin()) {
            return redirect()->route('admin.stats');
        }
        
        $role = $user->role->nom_role ?? 'user';
        
        // Récupérer les données pour les statistiques
        $stats = $this->getDashboardStats($user);
        
        // Récupérer les données pour les graphiques
        $chartData = $this->getChartData();
        
        return view('dashboard', compact('user', 'role', 'stats', 'chartData'));
    }

    public function stats()
    {
        $user = auth()->user();
        
        // Vérifier si l'utilisateur est un administrateur
        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
        
        $role = $user->role->nom_role ?? 'admin';
        
        // Récupérer les données pour les statistiques
        $stats = $this->getDashboardStats($user);
        
        // Récupérer les données pour les graphiques
        $chartData = $this->getChartData();
        
        // Extraire les données pour la vue
        $months = $chartData['months'];
        $userData = $chartData['userData'];
        $contentData = $chartData['contentData'];
        
        return view('stats', compact('user', 'role', 'stats', 'chartData', 'months', 'userData', 'contentData'));
    }

    private function getDashboardStats($user)
    {
        return [
            'utilisateurs' => [
                'total' => User::count(),
                'nouveaux_mois' => User::where('created_at', '>=', now()->startOfMonth())->count(),
                'class' => 'bg-primary',
                'icon' => 'users'
            ],
            'contenus' => [
                'total' => Contenu::count(),
                'nouveaux_mois' => Contenu::where('created_at', '>=', now()->startOfMonth())->count(),
                'class' => 'bg-success',
                'icon' => 'file-text'
            ],
            'commentaires' => [
                'total' => Commentaire::count(),
                'nouveaux_mois' => Commentaire::where('created_at', '>=', now()->startOfMonth())->count(),
                'class' => 'bg-info',
                'icon' => 'message-square'
            ],
            'medias' => [
                'total' => Media::count(),
                'nouveaux_mois' => Media::where('created_at', '>=', now()->startOfMonth())->count(),
                'class' => 'bg-warning',
                'icon' => 'image'
            ]
        ];
    }

    private function getChartData()
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(null, $month, 1)->format('M');
        });

        $userData = collect(range(1, 12))->map(function ($month) {
            return User::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        $contentData = collect(range(1, 12))->map(function ($month) {
            return Contenu::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        });

        return [
            'months' => $months,
            'userData' => $userData,
            'contentData' => $contentData
        ];
    }
}