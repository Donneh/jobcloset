<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'description' => $this->faker->paragraph(),
            'image_path' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomDigitNotZero(),
            'tenant_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
