<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('personnels')) {
            Schema::create('personnels', function (Blueprint $table) {
                $table->id();
                // Colonnes
                $table->integer('nbre_de_femmes');
                $table->integer('nbre_de_hommes');
                $table->integer('nbre_religieux');
                $table->integer('nbre_religieuse');
                $table->integer('nbre_pretre');
                $table->integer('nbre_soeur');
                $table->integer('nbre_autres_religieux');
                $table->integer('nbre_enseignant_f');
                $table->integer('nbre_enseignant_h');
                // Clés étrangères
                $table->foreignId('annee_id')->constrained('years')->onDelete('cascade');
                $table->foreignId('ecole_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
