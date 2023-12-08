<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sku>
 */
class SkuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'sku' => $this->faker->asciify('******'),
            'currency' => 'EUR',
            'price' => $this->faker->randomNumber(4),
            'stock' => $this->faker->randomNumber(2),
            'tenant_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
