<?php

namespace Database\Factories;

use App\Models\CentroBuceo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CentroBuceo>
 */
class CentroBuceoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'direccion' => $this->faker->address,
            'accesible' => $this->faker->randomElement([0, 1]),
            'latitud' => $this->faker->randomFloat(6, 36.72016, 43.37125),
            'longitud' => $this->faker->randomFloat(6, -8.72264, 2.15899),
        ];
    }
}
