<?php

namespace Database\Factories;

use App\Models\Diocese;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diocese>
 */
class DioceseFactory extends Factory
{
    protected $model = Diocese::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Liste des diocèses du Bénin
        $dioceses = [
            'Diocèse de Cotonou',
            'Diocèse de Porto-Novo',
            'Diocèse de Parakou',
            'Diocèse de Natitingou',
            'Diocèse de Djougou',
            'Diocèse de Abomey',
            'Diocèse de Lokossa',
            'Diocèse de Ouidah',
            'Diocèse de Kandi',
            'Diocèse de Porto-Novo',
            'Diocèse de Ajao',
            'Diocèse de Savalou'
        ];

        return [
            'nom' => $this->faker->randomElement($dioceses),
        ];
    }
}
