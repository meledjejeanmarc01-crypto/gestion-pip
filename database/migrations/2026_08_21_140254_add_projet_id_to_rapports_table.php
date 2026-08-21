<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->foreignId('projet_id')
                ->nullable()
                ->after('id')
                ->constrained('projets')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropForeign(['projet_id']);
            $table->dropColumn('projet_id');
        });
    }
};