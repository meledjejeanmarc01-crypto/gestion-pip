<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('secteurs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom'); // infrastructures, sante, education, agriculture, energie, eau_potable, transports, developpement_local
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secteurs');
    }
};
