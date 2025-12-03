<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $columns = DB::select('SHOW COLUMNS FROM utilisateurs');
    echo "Structure de la table utilisateurs :\n";
    echo str_repeat("-", 100) . "\n";
    echo sprintf("%-20s %-15s %-10s %-10s %-20s %-10s\n", 
        'Champ', 'Type', 'Null', 'Clé', 'Valeur par défaut', 'Extra');
    echo str_repeat("-", 100) . "\n";
    
    foreach ($columns as $column) {
        echo sprintf("%-20s %-15s %-10s %-10s %-20s %-10s\n",
            $column->Field,
            $column->Type,
            $column->Null,
            $column->Key,
            $column->Default ?? 'NULL',
            $column->Extra
        );
    }
    
    // Vérifier si le rôle 'auteur' existe
    $role = DB::table('roles')->where('nom_role', 'auteur')->first();
    echo "\nRôle 'auteur' : " . ($role ? 'Trouvé (ID: ' . $role->id . ')' : 'Non trouvé') . "\n";
    
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
