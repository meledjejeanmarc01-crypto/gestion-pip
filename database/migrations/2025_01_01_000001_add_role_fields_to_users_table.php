<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ces colonnes existent déjà dans la base :
            // role
            // structure_id

            // Colonnes qui n'existent pas encore
            $table->unsignedBigInteger('region_id')->nullable()->after('structure_id');
            $table->boolean('actif')->default(true)->after('region_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['region_id', 'actif']);
        });
    }
};