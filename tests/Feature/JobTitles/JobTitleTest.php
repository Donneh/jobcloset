<?php


use App\Models\User;

test('can load job title index when signed in', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    $this->get(route('job-titles.index'))->assertOk();
});

test('cannot load job title index when not signed in', function () {
    $this->get(route('job-titles.index'))->assertRedirect(route('login'));
});


