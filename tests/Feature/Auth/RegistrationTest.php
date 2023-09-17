<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test("registration screen can be rendered", function () {
    $response = $this->get("/register");

    $response->assertStatus(200);
});

test("new users can register", function () {
    $response = $this->post("/register", [
        "company_name" => "Test Company",
        "name" => "Test User",
        "email" => "testuser@email.com",
        "password" => "password",
        "password_confirmation" => "password",
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test("passwords must match", function () {
    $response = $this->post("/register", [
        "company_name" => "Test Company",
        "name" => "Test User",
        "email" => "testuser@email.com",
        "password" => "password",
        "password_confirmation" => "wrongpassword",
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors("password");
});

test("email must be unique", function () {
    $user = User::factory()->create();

    $response = $this->post("/register", [
        "company_name" => "Test Company",
        "name" => "Test User",
        "email" => $user->email,
        "password" => "password",
        "password_confirmation" => "password",
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors("email");
});
