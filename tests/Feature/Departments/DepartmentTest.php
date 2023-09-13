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

});

it('can update a department', function() {

});

it('can delete a department', function() {

});

it('only shows departments for the current tenant', function() {
    $otherTenantsDepartments = Department::factory(5)->create();
    $user = User::factory()->create();
    $tenantDepartments = Department::factory(5)->create(['tenant_id' => $user->tenant_id]);

    $foo = Department::all();

    $this->actingAs($user)->get(route('department.index'))
        ->assertSee($tenantDepartments->first()->name)
        ->assertDontSee($otherTenantsDepartments->first()->name);
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

