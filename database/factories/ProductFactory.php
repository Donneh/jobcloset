<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomNumber(4),
            'currency' => 'EUR',
            'stock' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->paragraph(),
            'image_path' => $this->faker->imageUrl(),
            'tenant_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
