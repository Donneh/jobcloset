<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartButton extends Component
{
    public $totalQuantity = 0;


    public function mount(): void
    {
        $this->updateCartQuantity();
    }

    #[On('cart-updated')]
    public function updateCartQuantity(): void
    {
        $this->totalQuantity = CartService::getQuantityOfItemsInCart();
    }

    public function render()
    {
        return view('livewire.cart-button');
    }
}
