<?php

namespace Database\Seeders;

use App\Models\TypeMedia;
use Illuminate\Database\Seeder;

class TypeMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['nom_type_media' => 'Image'],
            ['nom_type_media' => 'Vidéo'],
            ['nom_type_media' => 'Audio'],
            ['nom_type_media' => 'Document'],
        ];

        foreach ($types as $type) {
            TypeMedia::updateOrCreate(
                ['nom_type_media' => $type['nom_type_media']],
                $type
            );
        }
    }
}

