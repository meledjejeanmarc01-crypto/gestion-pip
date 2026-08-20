<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // general, region, departement, secteur, financier, avancement, retards
            $table->string('titre');
            $table->json('filtres')->nullable(); // ex: {"region_id": 3, "secteur_id": 2}
            $table->json('donnees')->nullable(); // instantané des résultats au moment de la génération
            $table->foreignId('genere_par_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapports');
    }
};
