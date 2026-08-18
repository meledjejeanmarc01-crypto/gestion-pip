<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->text('description')->nullable();

            $table->foreignId('secteur_id')->constrained('secteurs')->restrictOnDelete();
            $table->foreignId('structure_id')->constrained('structures')->restrictOnDelete();

            // localisation (niveaux optionnels selon la portée du projet)
            $table->foreignId('district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();
            $table->foreignId('departement_id')->nullable()->constrained('departements')->nullOnDelete();
            $table->foreignId('sous_prefecture_id')->nullable()->constrained('sous_prefectures')->nullOnDelete();
            $table->foreignId('commune_id')->nullable()->constrained('communes')->nullOnDelete();

            $table->date('date_debut_prevue')->nullable();
            $table->date('date_fin_prevue')->nullable();
            $table->date('date_debut_reelle')->nullable();
            $table->date('date_fin_reelle')->nullable();

            $table->decimal('cout_previsionnel', 18, 2)->default(0);

            $table->enum('statut', ['planifie', 'en_cours', 'en_retard', 'suspendu', 'termine', 'cloture'])->default('planifie');
            $table->unsignedTinyInteger('avancement_physique')->default(0); // 0-100 %

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('cree_par_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
