<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ecole;
use App\Models\Diocese;
use App\Models\Personnel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Appeler le seeder UserSeeder
       $this->call(UserSeeder::class);
       // Créez 12 diocèses
       //Diocese::factory()->count(12)->create();
       // Créer les diocèses avec le factory
       Diocese::factory(12)->create()->each(function ($diocese) {
        // Pour chaque diocèse, créer entre 12 et 20 écoles
        Ecole::factory(rand(12, 20))->create([
            'diocese_id' => $diocese->id,
        ]);
        });

        $this->call([
            YearSeeder::class,
            PersonnelSeeder::class,
        ]);

        // Créer des écoles (si pas déjà fait)
        Ecole::factory(50)->create()->each(function ($ecole) {
            // Créer le personnel pour chaque école
            Personnel::factory()->create([
                'ecole_id' => $ecole->id,
            ]);
        });

       // Créer un utilisateur de test supplémentaire
       \App\Models\User::factory()->create([
           'name' => 'Test User',
           'email' => 'test@example.com',
       ]);
    }
}
