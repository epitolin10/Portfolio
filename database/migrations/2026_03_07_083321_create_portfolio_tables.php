<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Profil ──────────────────────────────────────────
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->nullable();
            $table->string('option')->default('SLAM'); // SISR ou SLAM
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->timestamps();
        });

        // ── Stages ──────────────────────────────────────────
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');              // "Stage 1 — Lycée XYZ"
            $table->string('entreprise');
            $table->string('secteur')->nullable();
            $table->string('ville')->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('maitre_stage')->nullable();
            $table->unsignedTinyInteger('annee')->default(1); // 1 ou 2
            $table->timestamps();
        });

        // ── Compétences B1 ──────────────────────────────────
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('intitule');          // libellé officiel complet
            $table->string('intitule_court');    // libellé court pour les tags
            $table->string('description_courte')->nullable();
            $table->string('icone')->nullable(); // emoji ou symbol
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });

        // ── Sous-compétences ────────────────────────────────
        Schema::create('sous_competences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competence_id')->constrained()->cascadeOnDelete();
            $table->string('intitule');
            $table->timestamps();
        });

        // ── Activités ───────────────────────────────────────
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('description_courte');
            $table->longText('description');
            $table->string('type')->default('stage'); // stage | ap | projet
            $table->string('outils')->nullable();
            $table->string('lien_externe')->nullable();
            $table->string('ap')->nullable();   // nom de l'AP si type=ap
            $table->date('date_realisation');
            $table->boolean('visible')->default(true);
            $table->boolean('mise_en_avant')->default(false);
            $table->foreignId('stage_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        // ── Pivot activite <-> compétence ───────────────────
        Schema::create('activite_competence', function (Blueprint $table) {
            $table->foreignId('activite_id')->constrained()->cascadeOnDelete();
            $table->foreignId('competence_id')->constrained()->cascadeOnDelete();
            $table->primary(['activite_id', 'competence_id']);
        });

        // ── Pivot activite <-> sous-compétence ──────────────
        Schema::create('activite_sous_competence', function (Blueprint $table) {
            $table->foreignId('activite_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sous_competence_id')->constrained()->cascadeOnDelete();
            $table->primary(['activite_id', 'sous_competence_id']);
        });

        // ── Captures / preuves ──────────────────────────────
        Schema::create('captures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activite_id')->constrained()->cascadeOnDelete();
            $table->string('chemin');
            $table->string('nom')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('captures');
        Schema::dropIfExists('activite_sous_competence');
        Schema::dropIfExists('activite_competence');
        Schema::dropIfExists('activites');
        Schema::dropIfExists('sous_competences');
        Schema::dropIfExists('competences');
        Schema::dropIfExists('stages');
        Schema::dropIfExists('profils');
    }
};