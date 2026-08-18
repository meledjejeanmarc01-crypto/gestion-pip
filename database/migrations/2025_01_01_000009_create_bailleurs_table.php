<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bailleurs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->enum('type', ['etat', 'partenaire_bilateral', 'partenaire_multilateral', 'prive', 'autre'])->default('etat');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('contact_email')->nullable();
            $table->string('contact_telephone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bailleurs');
    }
};
