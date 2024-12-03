<?php

namespace Database\Factories;

use App\Models\Professor;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turma>
 */
class TurmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'=> $this->faker->word(),
            'professor'=> (Professor::inRandomOrder()->first()),
            'curso'=> (Curso::inRandomOrder()->first()),
        ];
    }
}
