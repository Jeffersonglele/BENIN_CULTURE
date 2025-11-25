<?php

namespace Database\Seeders;

use App\Models\Langue;
use Illuminate\Database\Seeder;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langues = [
            [
                'nom_langue' => 'Fon',
                'code_langue' => 'FN',
                'description' => 'Langue fon parlée dans la région du Bénin.',
            ],
            [
                'nom_langue' => 'Yoruba',
                'code_langue' => 'YO',
                'description' => 'Langue yoruba parlée dans la région du Bénin.',
            ],
            [
                'nom_langue' => 'Dendi',
                'code_langue' => 'DE',
                'description' => 'Langue dendi parlée dans la région du Bénin.',
            ],
            [
                'nom_langue' => 'Goun',
                'code_langue' => 'GO',
                'description' => 'Langue goun parlée dans la région du Bénin.',
            ]
        ];

        foreach ($langues as $langue) {
            Langue::updateOrCreate(
                ['code_langue' => $langue['code_langue']],
                $langue
            );
        }
    }
}

