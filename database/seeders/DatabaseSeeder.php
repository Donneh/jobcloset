<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Sku;
use App\Models\SkuProductAttribute;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Product::factory(10)->create()->each(function ($product) {
            Sku::factory(random_int(1, 2))->create([
                'product_id' => $product->id
            ])->each(function ($sku) use ($product) {
                $attributes = ProductAttribute::factory(random_int(1, 2))->create([
                    'product_id' => $product->id
                ]);
                // For each attribute, create a SkuProductAttribute
                foreach ($attributes as $attribute) {
                    SkuProductAttribute::factory()->create([
                        'sku_id' => $sku->id,
                        'product_attribute_id' => $attribute->id
                    ]);
                }
            });
        });
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
