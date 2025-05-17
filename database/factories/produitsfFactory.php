<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produits>
 */
class produitsfactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titre' => fake()->title(),
            'description' => fake()->text(),
            'prix' => fake()->randomFloat(2, 1, 100),
            'quantite' => fake()->numberBetween(1, 100),
        ];
    }
}
