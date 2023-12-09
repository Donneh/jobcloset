<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Inertia\Testing\Assert as InertiaAssert;

uses(RefreshDatabase::class);

it('index displays the products ordered by creation date descending', function () {
    // Arrange
    Auth::shouldReceive('id')->andReturn(1);
    Gate::shouldReceive('authorize')
        ->with('viewAny', Product::class)
        ->andReturn(true);

    Product::factory()->count(3)->create();

    // Act
    $response = $this->get(route('products.index'));

    // Assert
    $response->assertInertia(function(InertiaAssert $page) {
        $page->component('Product/Index')
            ->where('products', Product::orderBy('created_at', 'desc')->get()->toArray());
    });
});
