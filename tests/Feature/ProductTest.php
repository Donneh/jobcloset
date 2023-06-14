<?php

use App\Models\Product;
use App\Models\User;

it('displays all products', function () {
    $user = User::factory()->create();
    $products = Product::factory()->count(3)->create();

    $response = $this->actingAs($this->user)->get('/products');
    // Assert
    $response
        ->assertStatus(200)
        ->assertSee($products[0]->name)
        ->assertSee($products[1]->name)
        ->assertSee($products[2]->name);
});
