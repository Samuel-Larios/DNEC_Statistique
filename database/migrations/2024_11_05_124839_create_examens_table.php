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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('serie');
            $table->foreignId('annee_id')->constrained('years')->onDelete('cascade');
            $table->foreignId('ecole_id')->constrained('ecoles')->onDelete('cascade');
            $table->integer('total_inscrit')->default(0)->nullable();
            $table->integer('fille')->default(0)->nullable();
            $table->integer('garcon')->default(0)->nullable();
            $table->integer('total_admis')->default(0)->nullable();
            $table->integer('fille_admis')->default(0)->nullable();
            $table->integer('garcon_admis')->default(0)->nullable();
            $table->integer('total_passable')->default(0)->nullable();
            $table->integer('fille_passable')->default(0)->nullable();
            $table->integer('garcon_passable')->default(0)->nullable();
            $table->integer('total_bien')->default(0)->nullable();
            $table->integer('fille_bien')->default(0)->nullable();
            $table->integer('garcon_bien')->default(0)->nullable();
            $table->integer('total_tbien')->default(0)->nullable();
            $table->integer('fille_tbien')->default(0)->nullable();
            $table->integer('garcon_tbien')->default(0)->nullable();
            $table->integer('total_honorable')->default(0)->nullable();
            $table->integer('fille_honorable')->default(0)->nullable();
            $table->integer('garcon_honorable')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
