<?php

namespace Database\Factories;

use App\Models\CalendarioCursos;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarioCursos>
 */
class CalendarioCursosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_curso' => Curso::factory(),
            'fecha' => $this->faker->dateTimeBetween(
                $startDate = 'now', $endDate = '+ 1 year', $timezone = null),
            'detalles' => $this->faker->text($maxNbChars = 400),
        ];
    }
}
