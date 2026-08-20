<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Étape 1 : on ajoute d'abord les colonnes SANS contrainte de clé étrangère
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('decideur')->after('email');
            // roles: admin_national, responsable_national, responsable_regional,
            // responsable_departemental, responsable_projet, agent_financier,
            // agent_suivi_evaluation, decideur
            $table->unsignedBigInteger('structure_id')->nullable()->after('role');
            $table->unsignedBigInteger('region_id')->nullable()->after('structure_id');
            $table->boolean('actif')->default(true)->after('region_id');
        });

        // Étape 2 : on ajoute les clés étrangères séparément, une fois les colonnes en place
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('structure_id')->references('id')->on('structures')->nullOnDelete();
            $table->foreign('region_id')->references('id')->on('regions')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['structure_id']);
            $table->dropForeign(['region_id']);
            $table->dropColumn(['role', 'structure_id', 'region_id', 'actif']);
        });
    }
};
