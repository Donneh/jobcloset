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
//
//        User::factory(10)->create()->each(function ($user) {
//            $user->assignRole('manager');
//
//            Product::factory(10)->create(['tenant_id' => $user->tenant_id]);
//        });

        $this->command->info('Database seeding completed successfully.');
    }
}
