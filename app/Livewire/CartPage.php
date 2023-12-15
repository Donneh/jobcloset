<?php

namespace App\Livewire;

use Adyen\Model\Checkout\Amount;
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
        if(CartService::getCartTotal()->getMinorAmount()->toInt() == 0) {
            // Create order without payment provider
            $order = new Order([
                'user_id' => auth()->user()->id,
                'number' => \Str::random(6),
                'payment_method' => 'none',
                'payment_status' => 'closed',
                'payment_reference' => 'none',
                'status' => 'Closed'
            ]);

            $order->save();

            Notification::make()
                ->title('Order placed succesfully')
                ->success()
                ->send();

            CartService::clearCart();

            return $this->redirect(route('shop.index'), navigate: true);
        }

        $paymentService = new PaymentService();

        $order = new Order([
            'user_id' => auth()->user()->id,
            'number' => \Str::random(6),
        ]);

        $response = $paymentService->createCheckoutRequest($order, new Amount([
            'currency' => 'EUR',
            'value' => CartService::getCartTotal()->getMinorAmount()->toInt(),
            ])
        );

        return redirect()->to($response['url']);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
