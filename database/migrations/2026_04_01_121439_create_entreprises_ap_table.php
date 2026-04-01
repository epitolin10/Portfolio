<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entreprises_ap', function (Blueprint $table) {
            $table->id();
            $table->string('nom');                  // Nom de l'entreprise
            $table->string('secteur')->nullable();  // Secteur d'activité
            $table->string('ville')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('site_web')->nullable();
            $table->string('referent')->nullable();  // Référent / tuteur
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entreprises_ap');
    }
};
