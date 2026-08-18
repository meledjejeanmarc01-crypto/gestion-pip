<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projet_id')->constrained('projets')->cascadeOnDelete();
            $table->string('libelle');
            $table->string('unite')->nullable();
            $table->decimal('valeur_cible', 18, 2)->nullable();
            $table->decimal('valeur_realisee', 18, 2)->nullable();
            $table->date('date_mesure')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicateurs');
    }
};
