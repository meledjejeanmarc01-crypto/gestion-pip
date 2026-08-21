<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')
                    ->default('agent_suivi_evaluation')
                    ->after('password');
            }

            if (!Schema::hasColumn('users', 'structure_id')) {
                $table->unsignedBigInteger('structure_id')
                    ->nullable()
                    ->after('role');
            }

            if (!Schema::hasColumn('users', 'region_id')) {
                $table->unsignedBigInteger('region_id')
                    ->nullable()
                    ->after('structure_id');
            }

            if (!Schema::hasColumn('users', 'actif')) {
                $table->boolean('actif')
                    ->default(true)
                    ->after('region_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'actif')) {
                $table->dropColumn('actif');
            }

            if (Schema::hasColumn('users', 'region_id')) {
                $table->dropColumn('region_id');
            }

            if (Schema::hasColumn('users', 'structure_id')) {
                $table->dropColumn('structure_id');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};