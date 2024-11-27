<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UtilisateurSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utilisateur spécifique
        Utilisateur::create([
            'name' => 'Lift Come',
            'email' => 'liftschool@gmail.com',
            'password' => Hash::make('liftschool'),
            'droit' => 'admin',
        ]);

        // Utilisation de Faker pour générer des utilisateurs aléatoires
        $faker = \Faker\Factory::create();
        foreach (range(1, 10) as $index) {
            Utilisateur::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'droit' => 'user',
            ]);
        }
    }
}
