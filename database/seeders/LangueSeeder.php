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
                'description' => 'Principale langue du Sud du Bénin, largement utilisée à Cotonou, Abomey et Porto-Novo. Le fon est une langue riche en proverbes, chants et traditions royales du royaume du Danhomè.',
            ],
            [
                'nom_langue' => 'Yoruba',
                'code_langue' => 'YO',
                'description' => 'Langue parlée surtout au Sud-Est du Bénin, notamment à Porto-Novo et dans les communautés yoruba du plateau. Dotée d’un héritage religieux et culturel fort.',
            ],
            [
                'nom_langue' => 'Dendi',
                'code_langue' => 'DE',
                'description' => 'Langue majeure du Nord du Bénin, surtout à Kandi et Malanville. Le dendi est influencé par le haoussa et le zarma.',
            ],
            [
                'nom_langue' => 'Goun',
                'code_langue' => 'GO',
                'description' => 'Langue étroitement liée au fon, principalement parlée à Porto-Novo et dans les régions avoisinantes. Très présente dans les arts traditionnels.',
            ],
            [
                'nom_langue' => 'Bariba',
                'code_langue' => 'BA',
                'description' => 'Langue parlée dans le Nord-Est du Bénin, notamment à Parakou et Nikki. Elle porte l’héritage guerrier et historique du royaume bariba.',
            ],
            [
                'nom_langue' => 'Adja',
                'code_langue' => 'AD',
                'description' => 'Langue parlée dans le Sud-Ouest du Bénin, surtout à Lokossa et Dogbo. L’adja est lié culturellement au fon et au goun.',
            ],
            [
                'nom_langue' => 'Béti',
                'code_langue' => 'BT',
                'description' => 'Langue parlée par des groupes minoritaires du Centre du Bénin. Riche en contes et traditions orales.',
            ],
            [
                'nom_langue' => 'Peulh (Fulfulde)',
                'code_langue' => 'PL',
                'description' => 'Langue des communautés nomades et semi-nomades peulhs, très présente dans le Nord du pays. Connue pour sa musicalité et son vocabulaire pastoral.',
            ],
            [
                'nom_langue' => 'Ottamari',
                'code_langue' => 'OT',
                'description' => 'Langue parlée dans la région de Natitingou par les peuples Somba. Elle accompagne une culture architecturale unique (tata somba).',
            ],
            [
                'nom_langue' => 'Wémè (Ouémègbé)',
                'code_langue' => 'WM',
                'description' => 'Langue parlée autour de la vallée de l’Ouémé. Très utilisée dans les chants et rituels traditionnels.',
            ],
            [
                'nom_langue' => 'Nagot',
                'code_langue' => 'NG',
                'description' => 'Langue yoruboïde parlée par les communautés nagot dans le centre et le sud du Bénin. Riche en traditions orales et en histoire migratoire.',
            ],
            [
                'nom_langue' => 'Ditamari',
                'code_langue' => 'DT',
                'description' => 'Langue parlée dans les montagnes de l’Atacora. Associée aux peuples tamberma, réputés pour leurs habitations fortifiées.',
            ],
        ];


        foreach ($langues as $langue) {
            Langue::updateOrCreate(
                ['code_langue' => $langue['code_langue']],
                $langue
            );
        }
    }
}

