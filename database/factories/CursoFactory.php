<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => 'Curso de '.$this->faker->words(3, true),
            'descripcion' => $this->faker->text(),
            'imagen' => 'curso-1.webp',
            'duracion' => ($this->faker->numberBetween(2, 10)) * 5,
        ];
    }
}
