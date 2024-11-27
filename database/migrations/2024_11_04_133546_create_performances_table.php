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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->string('classe');
            $table->integer('eleveInscrit');
            $table->integer('nbreFille');
            $table->integer('nbreGarcon');
            $table->integer('nbreMoyenne');
            $table->integer('nbreMfille');
            $table->integer('nbreMgarcon');
            $table->integer('nbreAbandon');
            $table->foreignId('annee_id')->constrained('years')->onDelete('cascade');
            $table->foreignId('ecole_id')->constrained('ecoles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
