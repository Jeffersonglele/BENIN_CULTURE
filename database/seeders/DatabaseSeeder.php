<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed dans l'ordre des dépendances
        $this->call([
            RoleSeeder::class,
            LangueSeeder::class,
            RegionSeeder::class,
            TypeMediaSeeder::class,
            TypeContenuSeeder::class,
            UtilisateurSeeder::class,
            ContenuSeeder::class,
            CommentaireSeeder::class,
            MediaSeeder::class,
            ParlerSeeder::class,
        ]);

        // User par défaut (si nécessaire)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
