<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Données de test
$userData = [
    'nom' => 'Test',
    'prenom' => 'User',
    'email' => 'test' . time() . '@example.com',
    'password' => 'password123',
    'date_naissance' => '2000-01-01',
    'statut' => 'actif',
    'id_role' => 1, // ID du rôle auteur
    'id_langue' => 1,
    'date_inscription' => now(),
    'photo' => 'default.jpg',
    'created_at' => now(),
    'updated_at' => now(),
];

try {
    // 1. Essayer d'insérer directement avec le mot de passe hashé
    $userData['password'] = Hash::make($userData['password']);
    $userData['mot_de_passe'] = $userData['password'];
    
    $id = DB::table('utilisateurs')->insertGetId($userData);
    
    if ($id) {
        echo "Utilisateur créé avec succès (ID: $id)\n";
        
        // Vérifier que l'utilisateur peut se connecter
        $user = DB::table('utilisateurs')->where('id', $id)->first();
        
        if ($user && Hash::check('password123', $user->password)) {
            echo "Le mot de passe est correctement hashé et vérifiable.\n";
            
            // Afficher les informations de l'utilisateur (sans le mot de passe)
            unset($user->password);
            unset($user->mot_de_passe);
            print_r($user);
        } else {
            echo "Erreur : Le mot de passe n'a pas pu être vérifié.\n";
        }
    } else {
        echo "Échec de la création de l'utilisateur.\n";
    }
    
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    echo "Trace : " . $e->getTraceAsString() . "\n";
}
