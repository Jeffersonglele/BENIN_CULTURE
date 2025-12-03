<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Supprimer la contrainte de clé étrangère si elle existe (on utilise un bloc try-catch pour gérer le cas où elle n'existe pas)
        try {
            Schema::table('login_histories', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        } catch (\Exception $e) {
            // La contrainte n'existe pas, on continue
        }

        // Si la colonne user_type n'existe pas, on l'ajoute
        if (!Schema::hasColumn('login_histories', 'user_type')) {
            Schema::table('login_histories', function (Blueprint $table) {
                $table->string('user_type')->nullable();
            });
        }

        // Mettre à jour les données existantes
        \DB::table('login_histories')
            ->whereNull('user_type')
            ->update([
                'user_type' => 'App\\Models\\User' // Mettez le bon namespace de votre modèle User
            ]);

        // S'assurer que la colonne user_id est nullable
        Schema::table('login_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer la colonne user_type si elle existe
        if (Schema::hasColumn('login_histories', 'user_type')) {
            Schema::table('login_histories', function (Blueprint $table) {
                $table->dropColumn('user_type');
            });
        }

        // S'assurer que la colonne user_id n'est plus nullable
        Schema::table('login_histories', function (Blueprint $table) {
            // Mettre à jour les valeurs NULL si nécessaire
            \DB::table('login_histories')
                ->whereNull('user_id')
                ->update(['user_id' => 1]); // Remplacez 1 par un ID utilisateur valide
                
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });

        // Recréer la contrainte de clé étrangère
        Schema::table('login_histories', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
};
