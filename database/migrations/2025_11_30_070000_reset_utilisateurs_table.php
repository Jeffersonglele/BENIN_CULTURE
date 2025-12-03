<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResetUtilisateursTable extends Migration
{
    public function up()
    {
        // Désactiver temporairement les contraintes de clé étrangère
        Schema::disableForeignKeyConstraints();
        
        // Vider la table
        \DB::table('utilisateurs')->truncate();
        
        // Réactiver les contraintes
        Schema::enableForeignKeyConstraints();
        
        // Modifier la table pour s'assurer qu'elle a la bonne structure
        Schema::table('utilisateurs', function (Blueprint $table) {
            // S'assurer que le champ password existe et est correctement configuré
            if (!Schema::hasColumn('utilisateurs', 'password')) {
                $table->string('password')->after('email');
            }
            
            // S'assurer que le champ mot_de_passe existe et est correctement configuré
            if (!Schema::hasColumn('utilisateurs', 'mot_de_passe')) {
                $table->string('mot_de_passe')->after('password');
            }
            
            // S'assurer que le champ remember_token existe
            if (!Schema::hasColumn('utilisateurs', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    public function down()
    {
        // Cette migration ne peut pas être annulée car elle supprime des données
    }
}
