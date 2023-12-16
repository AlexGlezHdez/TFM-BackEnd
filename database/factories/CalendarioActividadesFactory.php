<?php

namespace Database\Factories;

use App\Models\CalendarioActividades;
use App\Models\Actividad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarioActividades>
 */
class CalendarioActividadesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_actividad' => Actividad::factory(),
            'fecha' => $this->faker->dateTimeBetween(
                $startDate = 'now', $endDate = '+ 1 year', $timezone = null),
            'detalles' => $this->faker->text($maxNbChars = 400),
            'plazas' => $this->faker->numberBetween(5, 50)
        ];
    }
}
