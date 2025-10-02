<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscripcion>
 */
class InscripcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'curso_id' => Curso::inRandomOrder()->first()->id,  
            'persona_id' => Persona::inRandomOrder()->first()->id, 
            'fecha' => $this->faker->dateTimeBetween('-1 years', 'now'), 
            'monto' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
