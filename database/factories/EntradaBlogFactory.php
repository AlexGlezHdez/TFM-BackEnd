<?php

namespace Database\Factories;

use App\Models\EntradaBlog;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntradaBlog>
 */
class EntradaBlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo_entrada' => $this->faker->text($maxNbChars = 75),
            'imagen' => 'noticia-1.webp',
            'contenido' => $this->faker->text($maxNbChars = 400),
            'fecha_publicacion' => $this->faker->dateTimeThisDecade($max = 'now'),
            'id_autor' => Autor::factory()
        ];
    }
}
