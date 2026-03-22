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
        Schema::create('competences_acquises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');               // HTML, CSS, JS, Laravel...
            $table->string('categorie');          // Langages, Frameworks, Outils, etc.
            $table->string('image')->nullable();  // chemin vers l'image uploadée
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences_acquises');
    }
};
