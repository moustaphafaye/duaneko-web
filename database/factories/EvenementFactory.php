<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evenement>
 */
class EvenementFactory extends Factory
{
     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'description' => $this->faker->slug,
            'date_evenement' => $this -> faker -> dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'agent_id' => \App\Models\Agent::factory(),
        ];
    }
}
