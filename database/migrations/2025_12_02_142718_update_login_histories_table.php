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
        // Supprimer la contrainte de clé étrangère existante
        Schema::table('login_histories', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        // Modifier la colonne user_id pour la rendre nullable
        Schema::table('login_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('user_type')->nullable()->after('user_id');
        });
        
        // Recréer la contrainte de clé étrangère
        Schema::table('login_histories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer la contrainte de clé étrangère
        Schema::table('login_histories', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
        // Revenir à la colonne user_id non nullable et supprimer user_type
        Schema::table('login_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->dropColumn('user_type');
        });
        
        // Recréer la contrainte de clé étrangère
        Schema::table('login_histories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
