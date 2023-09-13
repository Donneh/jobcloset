<?php

use App\Models\Department;
use App\Models\User;

it('can create a department', function () {
    $this->user = User::factory()->create();
    $department = Department::factory()->create([
        'tenant_id' => $this->user->tenant_id,
    ]);

    $this->assertDatabaseHas('departments', [
        'name' => $department->name,
        'tenant_id' => $department->tenant_id,
    ]);
});
