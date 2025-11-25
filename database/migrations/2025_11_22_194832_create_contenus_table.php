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
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 255);
            $table->text('texte')->nullable();
            $table->string('statut',50)->default('en_attente');
            $table->date('date_creation');
            $table->date('date_validation');
            $table->foreignId('id_region')
                ->constrained('regions','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_langue')
                ->constrained('langues','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_moderateur')
                ->constrained('utilisateurs','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_type_contenu')
                ->constrained('type_contenus','id')   // table liée
                ->onDelete('cascade');
            $table->foreignId('id_auteur')
                ->constrained('utilisateurs','id')   // table liée
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
