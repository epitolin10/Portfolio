<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudes', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');               // Ex : BTS SIO option SLAM
            $table->string('etablissement');          // Ex : Lycée Jean Moulin
            $table->string('ville')->nullable();
            $table->string('niveau')->nullable();     // Ex : Bac+2, Baccalauréat...
            $table->string('mention')->nullable();    // Ex : Très bien, Assez bien...
            $table->date('date_debut');
            $table->date('date_fin')->nullable();     // null = en cours
            $table->boolean('en_cours')->default(false);
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudes');
    }
};
