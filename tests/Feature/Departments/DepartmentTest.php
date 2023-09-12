<?php

use App\Models\Department;
use App\Models\User;

it('can add department', function () {
    $this->user = User::factory()->create();
    $department = Department::factory()->create();

    $response = $this->actingAs($this->user)->get('/departments');

    $response
        ->assertStatus(200)
        ->assertSee($department->name);
});
