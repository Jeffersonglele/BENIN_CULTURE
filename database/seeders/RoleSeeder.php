<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nom_role' => 'Administrateur'],
            ['nom_role' => 'Modérateur'],
            ['nom_role' => 'Auteur'],
            ['nom_role' => 'Lecteur'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['nom_role' => $role['nom_role']],
                $role
            );
        }
    }
}

