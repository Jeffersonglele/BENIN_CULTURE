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
                'description' => 'Région urbaine et économique abritant Cotonou, la plus grande ville du Bénin. Centre commercial majeur, port autonome et carrefour culturel moderne.',
                'population' => 2200000,
                'superficie' => 79,
                'localisation' => 'Sud du Bénin',
            ],
            [
                'nom_region' => 'Atlantique',
                'description' => 'Région côtière avec de belles plages, la ville historique d’Abomey-Calavi et des zones touristiques très développées.',
                'population' => 1250000,
                'superficie' => 3233,
                'localisation' => 'Sud du Bénin',
            ],
            [
                'nom_region' => 'Ouémé',
                'description' => 'Région traversée par le fleuve Ouémé, regroupant Porto-Novo et de riches traditions culturelles. Importante activité agricole.',
                'population' => 1150000,
                'superficie' => 1281,
                'localisation' => 'Sud-Est du Bénin',
            ],
            [
                'nom_region' => 'Plateau',
                'description' => 'Région vallonnée à forte activité agricole, connue pour ses cultures vivrières et ses marchés traditionnels animés.',
                'population' => 850000,
                'superficie' => 3264,
                'localisation' => 'Sud-Est du Bénin',
            ],
            [
                'nom_region' => 'Mono',
                'description' => 'Région frontalière du Togo, riche en plages, villages de pêcheurs et fêtes traditionnelles.',
                'population' => 500000,
                'superficie' => 1396,
                'localisation' => 'Sud-Ouest du Bénin',
            ],
            [
                'nom_region' => 'Couffo',
                'description' => 'Région rurale à fort patrimoine culturel adja. Climat propice à l’agriculture et aux cultures maraîchères.',
                'population' => 750000,
                'superficie' => 2404,
                'localisation' => 'Sud-Ouest du Bénin',
            ],
            [
                'nom_region' => 'Zou',
                'description' => 'Région historique abritant Abomey, ancienne capitale du royaume du Danhomè. Très riche en musées, traditions et monuments.',
                'population' => 1100000,
                'superficie' => 5263,
                'localisation' => 'Centre-Sud du Bénin',
            ],
            [
                'nom_region' => 'Collines',
                'description' => 'Région montagneuse et au centre du pays, connue pour ses collines, ses paysages naturels et ses chefferies traditionnelles.',
                'population' => 800000,
                'superficie' => 13631,
                'localisation' => 'Centre du Bénin',
            ],
            [
                'nom_region' => 'Borgou',
                'description' => 'Région vaste et stratégique abritant Parakou. Carrefour commercial du Centre-Nord, diverse en ethnies et traditions.',
                'population' => 1500000,
                'superficie' => 25956,
                'localisation' => 'Centre-Nord du Bénin',
            ],
            [
                'nom_region' => 'Alibori',
                'description' => 'Plus grande région du Bénin, abritant Kandi et Malanville. Riche en élevage, agriculture et culture dendi.',
                'population' => 900000,
                'superficie' => 26242,
                'localisation' => 'Nord-Est du Bénin',
            ],
            [
                'nom_region' => 'Atacora',
                'description' => 'Région montagneuse et touristique avec Natitingou, les cascades, le parc de la Pendjari et les habitats tata somba.',
                'population' => 800000,
                'superficie' => 20199,
                'localisation' => 'Nord-Ouest du Bénin',
            ],
            [
                'nom_region' => 'Donga',
                'description' => 'Région montagneuse et agricole abritant Djougou. Mélange de cultures bariba, peulh et yom.',
                'population' => 700000,
                'superficie' => 11126,
                'localisation' => 'Nord-Ouest du Bénin',
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

