<?php

namespace Database\Seeders;

use App\Models\Contenu;
use App\Models\Utilisateur;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Database\Seeder;

class ContenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les IDs nécessaires
        $auteurs = Utilisateur::pluck('id')->toArray();
        $moderateurs = Utilisateur::where('statut', 'modérateur')->pluck('id')->toArray();
        if (empty($moderateurs)) {
            $moderateurs = Utilisateur::pluck('id')->toArray();
        }
        $regions = Region::pluck('id')->toArray();
        $langues = Langue::pluck('id')->toArray();
        $typesContenu = TypeContenu::pluck('id')->toArray();

        $contenus = [
            [
                'titre' => 'La Fête du vodoun',
                'texte' => 'La Fête du vodoun est une cérémonie traditionnelle du Bénin. Elle est célébrée en l\'honneur des ancêtres et des esprits.',
                'statut' => 'validé',
                'date_creation' => '2024-01-25',
                'date_validation' => '2024-01-27',
                'id_region' => $regions[2] ?? 1,
                'id_langue' => $langues[0] ?? 1,
                'id_moderateur' => $moderateurs[0] ?? 1,
                'id_type_contenu' => $typesContenu[0] ?? 1,
                'id_auteur' => $auteurs[1] ?? 1,
            ],
        ];

        foreach ($contenus as $contenu) {
            Contenu::updateOrCreate(
                ['titre' => $contenu['titre']],
                $contenu
            );
        }
    }
}

