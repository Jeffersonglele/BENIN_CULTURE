<?php

namespace Database\Seeders;

use App\Models\TypeContenu;
use Illuminate\Database\Seeder;

class TypeContenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['nom_type_contenu' => 'Article'],
            ['nom_type_contenu' => 'Histoire'],
            ['nom_type_contenu' => 'Tradition'],
            ['nom_type_contenu' => 'Recette'],
            ['nom_type_contenu' => 'Musique'],
            ['nom_type_contenu' => 'Danse'],
        ];

        foreach ($types as $type) {
            TypeContenu::updateOrCreate(
                ['nom_type_contenu' => $type['nom_type_contenu']],
                $type
            );
        }
    }
}

