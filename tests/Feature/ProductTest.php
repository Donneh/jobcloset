<?php

use App\Models\Product;

it('can be created', function () {
    $product = Product::factory()->create();

    expect($product->id)->toBe(1);
});
