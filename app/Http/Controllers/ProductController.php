<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $product->image_path = Storage::url($product->image_path);
        return Inertia::render('Product/Edit', [
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image_path')) {
            Storage::delete('public/' . $product->image_path);
            $path = $request->file('image_path')->store('/products', 'public');
            $validatedData['image_path'] = $path;
        }

        $product->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'description' => $validatedData['description'],
            'image_path' => $validatedData['image_path'],
        ]);

        return Redirect::route('product.edit', $product)->with('status', 'Product updated.');
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('image')->store('/products', 'public');

        Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'description' => $validatedData['description'],
            'image_path' => $path,
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

    public function destroy(Product $product)
    {
        Storage::delete('public/' . $product->image_path);
        $product->delete();

        return Redirect::route('product.index')->with('status', 'Product deleted.');
    }
}
