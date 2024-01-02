<?php

namespace App\Livewire;

use Adyen\Model\Checkout\Amount;
use App\Events\OrderPlaced;
use App\Models\Order;
use App\Services\CartService;
use App\Services\PaymentService;
use Brick\Money\Money;
use Filament\Notifications\Notification;
use Livewire\Attributes\On;
use Livewire\Component;

class CartPage extends Component
{


    public $totalPrice;
    public $items;

    public function mount()
    {
        $this->totalPrice = CartService::getCartTotal()->getAmount()->toFloat();
        $this->items = CartService::getCart();
    }

    public function placeOrder()
    {
        OrderPlaced::fire();

        $this->items = [];
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
