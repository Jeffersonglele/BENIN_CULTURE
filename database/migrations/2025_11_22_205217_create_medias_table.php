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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('chemin',255);
            $table->text('description');
            $table->foreignId('id_contenu')
                ->constrained('contenus','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_type_contenu')
                ->constrained('type_contenus','id')   // table liée
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
