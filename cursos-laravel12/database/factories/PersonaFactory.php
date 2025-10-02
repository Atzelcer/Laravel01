<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_documento' => $this->faker->unique()->numerify('########'),
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'sexo' => $this->faker->randomElement(['M','F']),
            'fecha_nacimiento' => $this->faker->date(),
            'celular' => $this->faker->phoneNumber(),
        ];
    }
}
