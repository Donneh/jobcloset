<?php

namespace App\Services;

use Brick\Money\Money;

class CartService
{
    public static function getCart()
    {
        return session()->get('cart');
    }

    public static function addToCart($product)
    {
        $cart = session()->get('cart');
        if ($cart) {
            if (array_key_exists($product->id, $cart['items'])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    'quantity' => 1,
                    'product' => $product
                ];
            }
        } else {
            $cart = (object)[
                $product->id => [
                    'quantity' => 1,
                    'product' => $product
                ]
            ];
        }
        session()->put('cart', $cart);
    }

    public static function removeFromCart($product)
    {
        $cart = session()->get('cart');
        if ($cart) {
            if (array_key_exists($product->id, $cart)) {
                $cart[$product->id]['quantity']--;
                if ($cart[$product->id]['quantity'] == 0) {
                    unset($cart[$product->id]);
                }
            }
        }
        session()->put('cart', $cart);
    }

    public static function removeProductFromCart($product)
    {
        $cart = session()->get('cart');
        if ($cart) {
            if (array_key_exists($product->id, $cart)) {
                unset($cart[$product->id]);
            }
        }
        session()->put('cart', $cart);
    }

    public static function clearCart()
    {
        session()->forget('cart');
    }

    public static function getCartTotal()
    {
        $cart = session()->get('cart');
        $total = Money::of(0, 'EUR');
        if ($cart) {
            foreach ($cart->items as $id => $item) {
                $itemTotal = $item['product']->price->multipliedBy($item['quantity']);
                $total = $total->plus($itemTotal);
            }
        }

        return $total;
    }
}
