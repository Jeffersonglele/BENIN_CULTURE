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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('texte');
            $table->integer('note');
            $table->date('date');
            $table->foreignId('id_utilisateur')
                ->constrained('utilisateurs','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_contenu')
                ->constrained('contenus','id')   // table liée
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
