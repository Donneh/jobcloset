<?php

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows all departments', function() {
    $user = User::factory()->create();
    $this->actingAs($user);

    Department::factory()->create(['name' => 'Sales']);
    Department::factory()->create(['name' => 'Marketing']);
    Department::factory()->create(['name' => 'Engineering']);

    get(route('department.index'))
        ->assertSee('Sales')
        ->assertSee('Marketing')
        ->assertSee('Engineering');
});

it('can show a department', function() {
    $department = Department::factory()->create(['name' => 'Sales']);
    $user = User::factory()->create();
    $this->actingAs($user)->get(route('department.show', $department))
        ->assertSee('Sales');
});

it('can update a department', function() {
    $department = Department::factory()->create(['name' => 'Sales']);
    $user = User::factory()->create();
    $this->actingAs($user)->patch(route('department.update', $department), [
        'name' => 'Marketing',
    ]);

    $this->assertDatabaseHas('departments', [
        'name' => 'Marketing',
    ]);
});

it('can delete a department', function() {
    $department = Department::factory()->create(['name' => 'Sales']);
    $user = User::factory()->create();
    $this->actingAs($user)->delete(route('department.destroy', $department));

    $this->assertDatabaseMissing('departments', [
        'name' => 'Sales',
    ]);
});

it('only shows departments for the current tenant', function() {
    $otherTenantsDepartment = Department::factory()->create();
    $user = User::factory()->create();

    $tenantDepartment = Department::factory()->create(['tenant_id' => $user->tenant_id]);

    session()->put('tenant_id', $user->tenant_id);
    $this->actingAs($user)->get(route('department.index'))
        ->assertSee($tenantDepartment->name)
        ->assertDontSee($otherTenantsDepartment->name);
});

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

