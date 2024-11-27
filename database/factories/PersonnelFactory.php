<?php

namespace Database\Factories;

use App\Models\Year;
use App\Models\Ecole;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    protected $model = Personnel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $anneeId = Year::where('year', 2023)->first()->id;

        return [
            'nbre_de_femmes' => $this->faker->numberBetween(5, 30),
            'nbre_de_hommes' => $this->faker->numberBetween(5, 30),
            'nbre_religieux' => $this->faker->numberBetween(0, 5),
            'nbre_religieuse' => $this->faker->numberBetween(0, 5),
            'nbre_pretre' => $this->faker->numberBetween(0, 3),
            'nbre_soeur' => $this->faker->numberBetween(0, 5),
            'nbre_autres_religieux' => $this->faker->numberBetween(0, 3),
            'nbre_enseignant_f' => $this->faker->numberBetween(5, 20),
            'nbre_enseignant_h' => $this->faker->numberBetween(5, 20),
            'annee_id' => Year::factory(), // Associer le personnel à une année
            'ecole_id' => Ecole::factory(), // Associer le personnel à une école
        ];

    }
}
