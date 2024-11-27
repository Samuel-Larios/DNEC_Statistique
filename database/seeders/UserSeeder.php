<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crée un utilisateur avec des informations spécifiques
        User::factory()->create([
            'name' => 'Samuel Larios',
            'email' => 'samuellarios71@gmail.com',
            'password' => bcrypt('password'),
            'droit' => 'admin',
            'photo' => null,
        ]);

        // Crée 10 autres utilisateurs manuellement avec des données réalistes
        $usersData = [
            ['name' => 'Alice Dupont', 'email' => 'alice.dupont@example.com'],
            ['name' => 'Bob Martin', 'email' => 'bob.martin@example.com'],
            ['name' => 'Clara Bernard', 'email' => 'clara.bernard@example.com'],
            ['name' => 'David Lefèvre', 'email' => 'david.lefevre@example.com'],
            ['name' => 'Eva Moreau', 'email' => 'eva.moreau@example.com'],
            ['name' => 'François Gauthier', 'email' => 'francois.gauthier@example.com'],
            ['name' => 'Gabrielle Petit', 'email' => 'gabrielle.petit@example.com'],
            ['name' => 'Hugo Rousseau', 'email' => 'hugo.rousseau@example.com'],
            ['name' => 'Isabelle Simon', 'email' => 'isabelle.simon@example.com'],
            ['name' => 'Julien Dubois', 'email' => 'julien.dubois@example.com'],
        ];

        foreach ($usersData as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
                'droit' => 'inscrire',
                'photo' => null,
            ]);
        }
    }
}
