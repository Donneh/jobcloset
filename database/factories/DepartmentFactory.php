<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'tenant_id' => $this->faker->numberBetween(1, 10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
