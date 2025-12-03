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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 100)->unique();
            $table->string('statut',50)->default('en_attente');
            $table->date('date_naissance');
            $table->date('date_inscription');
            $table->string('mot_de_passe', 255);
            $table->string('photo');
            $table->foreignId('id_role')
                ->constrained('roles','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_langue')
                ->constrained('langues','id')   // table liée
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
