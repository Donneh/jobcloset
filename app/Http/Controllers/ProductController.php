<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function create()
    {
        return Inertia::render('Product/Create', [
            'status' => session('status'),
        ]);
    }

    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            'product' => $product,
        ]);
    }

    public function update($request, $product)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['numeric'],
            'stock' => ['numeric'],
            'description' => ['string'],
            'image' => ['image'],
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $request->image_path,
        ]);

        return Redirect::route('product.edit', $product)->with('status', 'Product updated.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['numeric'],
            'stock' => ['numeric'],
            'description' => ['string'],
            'image' => ['image'],
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $request->image_path,
        ]);

        return Redirect::route('product.create')->with('status', 'Product created.');
    }

    public function index()
    {
        $products = Product::paginate(10);

        return Inertia::render('Product/Index', [
            'products' => $products,
        ]);
    }
}
