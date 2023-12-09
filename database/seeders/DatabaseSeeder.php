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
        $this->call(RolesAndPermissionsSeeder::class);

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('manager');

            Product::factory(10)->create(['tenant_id' => $user->tenant_id])->each(function ($product) use ($user) {
                $this->command->info('Creating SKUs for product ' . $product->id);

                Sku::factory(random_int(1, 2))->create([
                    'product_id' => $product->id,
                    'tenant_id' => $user->tenant_id
                ])->each(function ($sku) use ($product, $user) {
                    $this->command->info('Creating attributes for SKU ' . $sku->id);

                    $attributes =
                        ProductAttribute::factory(random_int(1, 2))->make([
                            'product_id' => $product->id,
                            'tenant_id' => $user->tenant_id
                        ])->each(function ($attribute) {
                            $attribute->save();
                        });

                    foreach ($attributes as $attribute) {
                        SkuProductAttribute::factory()->create([
                            'sku_id' => $sku->id,
                            'product_attribute_id' => $attribute->id,
                            'tenant_id' => $user->tenant_id
                        ]);
                    }
                });
            });
        });

        $this->command->info('Database seeding completed successfully.');
    }
}
