<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $items = [];

        $cart = CartService::getCart()->items;
        foreach ($cart as $id => $item) {
            $items[] = [
                'id' => $id,
                'name' => $item['product']->name,
                'price' => $item['product']->price,
                'quantity' => $item['product']->quantity,
                'image_path' => \Storage::url($item['product']->image_path),
            ];
        }

        $total = CartService::getCartTotal();


        return Inertia::render('Cart/Index', compact('items', 'total'));
    }

    public function store(Product $product)
    {
        CartService::addToCart($product);

        return Redirect::route('shop.index')->with('message', 'Product added to cart successfully!');
    }

    public function destroy(Product $product)
    {
        CartService::removeProductFromCart($product);

        return Redirect::route('cart.index')->with('message', 'Item removed from cart!');
    }

    public function remove(Product $product)
    {
        CartService::removeFromCart($product);

        return Redirect::route('cart.index')->with('message', 'Product removed successfully!');
    }
}
