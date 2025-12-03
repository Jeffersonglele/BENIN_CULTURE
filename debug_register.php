<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// Activer le mode débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Créer un logger personnalisé
$logFile = storage_path('logs/debug_register.log');
$logger = new Monolog\Logger('debug_register');
$logger->pushHandler(new Monolog\Handler\StreamHandler($logFile, Monolog\Logger::DEBUG));

// Enregistrer la requête
$logger->info('=== NOUVELLE REQUÊTE ===');
$logger->info('Méthode: ' . ($_SERVER['REQUEST_METHOD'] ?? 'CLI'));
$logger->info('Données POST:', $_POST);

// Vérifier si c'est une soumission de formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Règles de validation
        $rules = [
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:utilisateurs,email'],
            'date_naissance' => ['required', 'date', 'before:today'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validator = Validator::make($_POST, $rules);
        
        if ($validator->fails()) {
            $logger->error('Échec de la validation', ['errors' => $validator->errors()->toArray()]);
            echo "Erreurs de validation :\n";
            print_r($validator->errors()->toArray());
            exit;
        }

        $validated = $validator->validated();
        $logger->info('Données validées:', $validated);

        // Hasher le mot de passe
        $hashedPassword = password_hash($validated['password'], PASSWORD_DEFAULT);
        $logger->info('Mot de passe hashé:', ['hash' => $hashedPassword]);

        // Récupérer le rôle 'auteur'
        $role = DB::table('roles')->where('nom_role', 'auteur')->first();
        
        if (!$role) {
            throw new Exception("Le rôle 'auteur' n'existe pas dans la base de données");
        }

        // Préparer les données pour l'insertion
        $userData = [
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => $hashedPassword,
            'mot_de_passe' => $hashedPassword, // Pour la rétrocompatibilité
            'date_naissance' => $validated['date_naissance'],
            'date_inscription' => now(),
            'statut' => 'actif',
            'photo' => 'default.jpg',
            'id_role' => $role->id,
            'id_langue' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $logger->info('Tentative d\'insertion dans la base de données', $userData);

        // Insérer l'utilisateur
        $userId = DB::table('utilisateurs')->insertGetId($userData);
        
        if ($userId) {
            $logger->info('Utilisateur créé avec succès', ['id' => $userId]);
            echo "Utilisateur créé avec succès (ID: $userId)\n";
            
            // Afficher l'utilisateur créé (sans le mot de passe)
            $user = DB::table('utilisateurs')->find($userId);
            unset($user->password, $user->mot_de_passe);
            echo "Détails de l'utilisateur :\n";
            print_r($user);
        } else {
            throw new Exception("Échec de l'insertion dans la base de données");
        }

    } catch (Exception $e) {
        $logger->error('ERREUR CRITIQUE', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        echo "Une erreur est survenue : " . $e->getMessage() . "\n";
        echo "Veuillez vérifier le fichier de log : $logFile\n";
    }
} else {
    // Afficher un formulaire de test
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test d'inscription</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
            .form-group { margin-bottom: 15px; }
            label { display: block; margin-bottom: 5px; }
            input[type="text"], input[type="email"], input[type="date"], input[type="password"] {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            button {
                background-color: #4CAF50;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover { background-color: #45a049; }
        </style>
    </head>
    <body>
        <h1>Test d'inscription</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="date_naissance">Date de naissance:</label>
                <input type="date" id="date_naissance" name="date_naissance" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required minlength="8">
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
            </div>
            
            <button type="submit">S'inscrire</button>
        </form>
    </body>
    </html>
    <?php
}
