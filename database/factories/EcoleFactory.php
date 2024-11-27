<?php

namespace Database\Factories;

use App\Models\Ecole;
use App\Models\Diocese;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ecole>
 */
class EcoleFactory extends Factory
{

    protected $model = Ecole::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company, // Nom aléatoire d'école
            'diocese_id' => Diocese::factory(), // Associer l'école à un diocèse
        ];
    }
}
