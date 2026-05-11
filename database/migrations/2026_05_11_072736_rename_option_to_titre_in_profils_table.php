<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->renameColumn('option', 'titre');
        });

        \DB::table('profils')->update(['titre' => 'BTS SIO — Option SLAM']);
    }

    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->renameColumn('titre', 'option');
        });
    }
};
