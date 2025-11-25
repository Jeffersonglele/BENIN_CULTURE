<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeContenu;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contenus = Contenu::pluck('id')->toArray();
        $typesContenu = TypeContenu::pluck('id')->toArray();

        $medias = [
            [
                'chemin' => 'medias/images/fresque.jpg',
                'description' => 'Photo de fresque',
                'id_contenu' => $contenus[0] ?? 1,
                'id_type_contenu' => $typesContenu[3] ?? 1,
            ],  
            [
                'chemin' => 'medias/images/paysage.jpg',
                'description' => 'Vue de paysage',
                'id_contenu' => $contenus[1] ?? 1,
                'id_type_contenu' => $typesContenu[1] ?? 1,
            ],
            [
                'chemin' => 'medias/videos/danse.mp4',
                'description' => 'Vidéo de danse',
                'id_contenu' => $contenus[2] ?? 1,
                'id_type_contenu' => $typesContenu[5] ?? 1,
            ],
            [
                'chemin' => 'medias/images/masques.webp',
                'description' => 'Collection de masques',
                'id_contenu' => $contenus[3] ?? 1,
                'id_type_contenu' => $typesContenu[2] ?? 1,
            ],
            [
                'chemin' => 'medias/images/festival.webp',
                'description' => 'Scène du Festival',
                'id_contenu' => $contenus[4] ?? 1,
                'id_type_contenu' => $typesContenu[0] ?? 1,
            ],
            [
                'chemin' => 'medias/documents/histoire.pdf',
                'description' => 'Document historique',
                'id_contenu' => $contenus[1] ?? 1,
                'id_type_contenu' => $typesContenu[1] ?? 1,
            ],
        ];

        foreach ($medias as $media) {
            Media::updateOrCreate(
                ['chemin' => $media['chemin']],
                $media
            );
        }
    }
}

