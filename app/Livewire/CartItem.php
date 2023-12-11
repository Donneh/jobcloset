<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class CartItem extends Component
{
    public $item;


    public function addOneToCart()
    {
        CartService::addToCart($this->item['product']);
    }

    public function removeFromCart()
    {
        CartService::removeFromCart($this->item['product']);
    }

    public function deleteFromCart()
    {
        CartService::removeProductFromCart($this->item['product']);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
