<?php

namespace Database\Seeders;

use App\Models\Ecole;
use App\Models\Personnel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer 50 écoles
        $ecoles = Ecole::factory(50)->create();

        // Créer du personnel pour chaque école
        $ecoles->each(function ($ecole) {
            Personnel::factory(rand(5, 10))->create([
                'ecole_id' => $ecole->id, // Associe chaque personnel à une école existante
            ]);
        });

    }

}
