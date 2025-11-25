<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'nom_region' => 'Littoral',
                'description' => 'Région du littoral du Bénin, centre économique et culturel.',
                'population' => 3500000,
                'superficie' => 550,
                'localisation' => 'Sud du Bénin',
            ],
            [
                'nom_region' => 'Borgou',
                'description' => 'Région du Borgou du Bénin, centre économique et culturel.',
                'population' => 1500000,
                'superficie' => 6670,
                'localisation' => 'Centre du Bénin',
            ],  
            [
                'nom_region' => 'Ouémé',
                'description' => 'Région de l\'Ouémé du Bénin, centre économique et culturel.',
                'population' => 250000,
                'superficie' => 19241,
                'localisation' => 'Centre du Bénin',
            ],
            [
                'nom_region' => 'Atacora',
                'description' => 'Région du Atacora du Bénin, riche en biodiversité et culture.',
                'population' => 1800000,
                'superficie' => 28350,
                'localisation' => 'Centre du Bénin',
            ],
            [
                'nom_region' => 'Alibori',
                'description' => 'Région de l\'Alibori du Bénin, centre économique et culturel.',
                'population' => 2000000,
                'superficie' => 252,
                'localisation' => 'Centre du Bénin',
            ],
        ];

        foreach ($regions as $region) {
            Region::updateOrCreate(
                ['nom_region' => $region['nom_region']],
                $region
            );
        }
    }
}

