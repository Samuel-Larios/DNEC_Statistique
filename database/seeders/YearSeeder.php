<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $years = [2022, 2023, 2024]; // Liste d'années à insérer

        foreach ($years as $year) {
            Year::updateOrCreate(['year' => $year], ['updated_at' => now(), 'created_at' => now()]);
        }
    }

}
