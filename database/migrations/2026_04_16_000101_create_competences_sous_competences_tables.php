<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('intitule_court')->nullable();
            $table->string('description_courte')->nullable();
            $table->string('icone')->nullable();
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });

        Schema::create('sous_competences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competence_id')->nullable()->constrained()->nullOnDelete();
            $table->string('intitule');
            $table->timestamps();
        });

        Schema::create('activite_sous_competence', function (Blueprint $table) {
            $table->foreignId('activite_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sous_competence_id')->constrained()->cascadeOnDelete();
            $table->primary(['activite_id', 'sous_competence_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activite_sous_competence');
        Schema::dropIfExists('sous_competences');
        Schema::dropIfExists('competences');
    }
};
