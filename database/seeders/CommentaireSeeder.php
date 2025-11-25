<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Utilisateur;
use App\Models\Contenu;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utilisateurs = Utilisateur::pluck('id')->toArray();
        $contenus = Contenu::pluck('id')->toArray();

        $commentaires = [
            [
                'texte' => 'Excellent article ! Très instructif sur les traditions béninoises.',
                'note' => 5,
                'date' => '2024-01-25',
                'id_utilisateur' => $utilisateurs[1] ?? 1,
                'id_contenu' => $contenus[0] ?? 1,
            ],
            [
                'texte' => 'Merci pour ce partage. J\'ai appris beaucoup de choses sur l\'histoire.',
                'note' => 4,
                'date' => '2024-02-15',
                'id_utilisateur' => $utilisateurs[2] ?? 1,
                'id_contenu' => $contenus[1] ?? 1,
            ],
            [
                'texte' => 'La danse est vraiment fascinante. J\'aimerais en savoir plus.',
                'note' => 5,
                'date' => '2024-02-20',
                'id_utilisateur' => $utilisateurs[0] ?? 1,
                'id_contenu' => $contenus[2] ?? 1,
            ],
            [
                'texte' => 'Très bon article. J\'y étais l\'année dernière, c\'était magnifique !',
                'note' => 5,
                'date' => '2024-02-01',
                'id_utilisateur' => $utilisateurs[3] ?? 1,
                'id_contenu' => $contenus[4] ?? 1,
            ],
            [
                'texte' => 'Intéressant, mais j\'aurais aimé plus de détails sur les masques.',
                'note' => 3,
                'date' => '2024-03-05',
                'id_utilisateur' => $utilisateurs[1] ?? 1,
                'id_contenu' => $contenus[3] ?? 1,
            ],
        ];

        foreach ($commentaires as $commentaire) {
            Commentaire::updateOrCreate(
                [
                    'id_utilisateur' => $commentaire['id_utilisateur'],
                    'id_contenu' => $commentaire['id_contenu'],
                    'texte' => $commentaire['texte'],
                ],
                $commentaire
            );
        }
    }
}

