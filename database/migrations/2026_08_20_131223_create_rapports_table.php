<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // La table rapports existe déjà dans la base de données.
        // On la conserve afin de ne supprimer aucune donnée.
        if (!Schema::hasTable('rapports')) {
            Schema::create('rapports', function (Blueprint $table) {
                $table->id();
                $table->string('type');
                $table->string('titre');
                $table->json('filtres')->nullable();
                $table->json('donnees')->nullable();
                $table->foreignId('genere_par_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // On ne supprime pas une table existante contenant
        // potentiellement des données de l'ancien projet.
    }
};