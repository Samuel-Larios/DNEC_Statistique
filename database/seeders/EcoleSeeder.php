<?php

namespace Database\Seeders;

use App\Models\Diocese;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créez 12 diocèses
        $dioceses = Diocese::factory(12)->create();

        // Pour chaque diocèse, créez entre 5 et 10 écoles
        foreach ($dioceses as $diocese) {
            \App\Models\Ecole::factory(rand(5, 10))->create([
                'diocese_id' => $diocese->id, // Utilisez l'ID du diocèse créé
            ]);
        }
        $this->call(EcoleSeeder::class);
    }
}
