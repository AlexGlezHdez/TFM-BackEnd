<?php

namespace Database\Factories;

use App\Models\Actividad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actividad>
 */
class ActividadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actividad = ['Esqui en ', 'Senderismo por ', 'Ruta en bici en '];

        return [
            'titulo' => $this->faker->randomElement($actividad).$this->faker->words(2, true),
            'descripcion' => $this->faker->text(),
            'imagen' => 'actividad-1.webp',
        ];
    }
}
