<?php

namespace App\Services;

use App\Models\Product;
use Brick\Money\Money;
use Doctrine\DBAL\Schema\Table;
use Filament\Notifications\Notification;

class CartService
{
    public static function getCart()
    {
        return session()->get('cart');
    }

    public static function getQuantityOfItemsInCart(): int
    {
        $totalQuantity = 0;
        $cart = self::getCart();
        if($cart) {
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }
        }

        return $totalQuantity;
    }

    public static function addToCart($product)
    {
        if(is_array($product)) {
            $product = Product::find(array_key_first($product));
        }
        $cart = session()->get('cart');

        if ($cart) {
            if (array_key_exists($product->id, $cart)) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    'quantity' => 1,
                    'product' => $product,
                    'selectedOptions' => $product->id
                ];
            }
        } else {
            $cart[$product->id] = [
                'quantity' => 1,
                'product' => $product,
                'selectedOptions' => $product->id
            ];
        }
        session()->put('cart', $cart);
        Notification::make()
            ->title('Product added to cart')
            ->success()
            ->send();
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
            foreach ($cart as $id => $item) {
                $itemTotal = $item['product']->price * $item['quantity'];
                $total = $total->plus($itemTotal);
            }
        }

        return $total;
    }
}
