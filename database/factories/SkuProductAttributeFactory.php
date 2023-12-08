<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkuProductAttribute>
 */
class SkuProductAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_attribute_id' => \App\Models\ProductAttribute::factory(),
            'sku_id' => \App\Models\Sku::factory(),
            'tenant_id' => \App\Models\Tenant::factory(),
            'value' => $this->faker->word,
        ];
    }
}
