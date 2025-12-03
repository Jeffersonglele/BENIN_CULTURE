<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            // Modifier la colonne mot_de_passe pour accepter les valeurs nulles temporairement
            $table->string('mot_de_passe', 255)->nullable()->change();
            
            // Ajouter les champs manquants pour la compatibilité Laravel
            $table->string('password')->nullable()->after('mot_de_passe');
            $table->rememberToken()->after('password');
            $table->timestamp('email_verified_at')->nullable()->after('email');
        });
        
        // Mettre à jour les mots de passe existants
        \DB::statement("UPDATE utilisateurs SET password = mot_de_passe");
        
        // Rendre la colonne mot_de_passe non nullable à nouveau
        Schema::table('utilisateurs', function (Blueprint $table) {
            $table->string('mot_de_passe', 255)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            // Supprimer les champs ajoutés
            $table->dropColumn(['password', 'remember_token', 'email_verified_at']);
            
            // Rétablir la colonne mot_de_passe
            $table->string('mot_de_passe', 255)->change();
        });
    }
};
