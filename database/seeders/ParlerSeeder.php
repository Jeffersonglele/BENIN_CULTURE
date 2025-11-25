<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Langue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParlerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les IDs
        $regions = Region::all();
        $langues = Langue::all();

        $associations = [];

        foreach ($regions as $region) {
            foreach ($langues as $langue) {
                $associations[] = ['id_region' => $region->id, 'id_langue' => $langue->id];
            }
        }

        foreach ($associations as $association) {
            DB::table('parler')->insertOrIgnore([
                'id_region' => $association['id_region'],
                'id_langue' => $association['id_langue'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

