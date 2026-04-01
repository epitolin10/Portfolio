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
        Schema::table('entreprises_ap', function (Blueprint $table) {
            $table->dropColumn(['secteur', 'ville', 'description', 'site_web', 'referent']);
        });
    }

    public function down(): void
    {
        Schema::table('entreprises_ap', function (Blueprint $table) {
            $table->string('secteur')->nullable();
            $table->string('ville')->nullable();
            $table->text('description')->nullable();
            $table->string('site_web')->nullable();
            $table->string('referent')->nullable();
        });
    }
};
