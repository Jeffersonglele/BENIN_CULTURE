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
        // Désactiver temporairement les contraintes de clé étrangère
        Schema::table('contenus', function (Blueprint $table) {
            // Supprimer la contrainte existante
            $table->dropForeign(['id_moderateur']);
        });

        // Mettre à jour les valeurs NULL existantes vers 2
        DB::table('contenus')
            ->whereNull('id_moderateur')
            ->update(['id_moderateur' => 2]);

        // Recréer la contrainte avec la valeur par défaut
        Schema::table('contenus', function (Blueprint $table) {
            $table->foreignId('id_moderateur')
                ->default(2)
                ->change()
                ->constrained('utilisateurs', 'id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->dropForeign(['id_moderateur']);
        });

        // Remettre les valeurs à NULL si on fait un rollback
        DB::table('contenus')
            ->where('id_moderateur', 2)
            ->update(['id_moderateur' => null]);

        Schema::table('contenus', function (Blueprint $table) {
            $table->foreignId('id_moderateur')
                ->nullable()
                ->change()
                ->constrained('utilisateurs', 'id')
                ->onDelete('cascade');
        });
    }
};
