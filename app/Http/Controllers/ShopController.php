<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products->each(function ($product) {
            $product->image_path = \Storage::url($product->image_path);
        });

        return Inertia::render('Shop/Index', [
            'products' => $products
        ]);
    }
}
