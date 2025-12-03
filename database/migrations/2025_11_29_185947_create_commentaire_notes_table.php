<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commentaire_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commentaire_id')
                ->constrained('commentaires')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->tinyInteger('note')->unsigned();
            $table->timestamps();
            
            // Empêche un utilisateur de noter plusieurs fois le même commentaire
            $table->unique(['commentaire_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commentaire_notes');
    }
};