<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->foreignId('entreprise_ap_id')
                  ->nullable()
                  ->after('stage_id')
                  ->constrained('entreprises_ap')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->dropForeign(['entreprise_ap_id']);
            $table->dropColumn('entreprise_ap_id');
        });
    }
};
