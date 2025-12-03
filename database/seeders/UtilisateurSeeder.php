<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utilisateurs = [
            [
                'nom' => 'AGOSSA ',
                'prenom' => 'Eudes',
                'email' => 'eudes.agossa@example.com',
                'statut' => 'actif',
                'date_naissance' => '1990-05-15',
                'date_inscription' => '2024-01-10',
                'mot_de_passe' => Hash::make('password123'),
                'photo' => 'photos/eudes.jpg',
                'id_role' => 1,
                'id_langue' => 2,
            ],
            [
                'nom' => 'ASSANI',
                'prenom' => 'Amadis',
                'email' => 'assani.amadis@example.com',
                'statut' => 'actif',
                'date_naissance' => '1988-08-22',
                'date_inscription' => '2024-01-15',
                'mot_de_passe' => Hash::make('password123'),
                'photo' => 'photos/assani.jpg',
                'id_role' => 1,
                'id_langue' => 2,
            ],
            [
                'nom' => 'AYO',
                'prenom' => 'Ola',
                'email' => 'ola.ayo@example.com',
                'statut' => 'actif',
                'date_naissance' => '1992-03-10',
                'date_inscription' => '2024-02-01',
                'mot_de_passe' => Hash::make('password123'),
                'photo' => 'photos/ola.jpg',
                'id_role' => 1,
                'id_langue' => 2,
            ],
            [
                'nom' => 'AYO',
                'prenom' => 'Mari',
                'email' => 'aissatou.ayo@example.com',
                'statut' => 'modérateur',
                'date_naissance' => '1985-11-30',
                'date_inscription' => '2023-12-01',
                'mot_de_passe' => Hash::make('password123'),
                'photo' => 'photos/aissatou.jpg',
                'id_role' => 2,
                'id_langue' => 2,

            ],
            [
                'nom' => 'BEHANZIN',
                'prenom' => 'Jey',
                'email' => 'jey.behanzin@example.com',
                'statut' => 'en_attente',
                'date_naissance' => '1995-07-18',
                'date_inscription' => '2024-03-05',
                'mot_de_passe' => Hash::make('password123'),
                'photo' => 'photos/jey.jpg',
                'id_role' => 1,
                'id_langue' => 2,
            ],
        ];

        foreach ($utilisateurs as $utilisateur) {
            Utilisateur::updateOrCreate(
                ['email' => $utilisateur['email']],
                $utilisateur
            );
        }
    }
}

