<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use App\States\OrderState;
use Filament\Notifications\Notification;
use Glhd\Bits\Snowflake;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;
use Thunk\Verbs\Facades\Verbs;

class OrderPlaced extends Event
{

    #[StateId(OrderState::class)]
    public ?int $orderId = null;

    public function handle()
    {
        try {
            $order = Auth::user()->orders()->create([
                'number' => Snowflake::make(),
                'status' => OrderStatus::PENDING
            ]);

            $cartItems = CartService::getCart();

            foreach ($cartItems as $key => $cartItem) {
                $product = Product::findOrFail($key);

                if ($product->stock < $cartItem['quantity']) {
                    throw new \Exception("Insufficient stock for product with id: {$product->id}");
                }

                $order->orderItems()->create([
                    'id' => $this->orderId,
                    'product_id' => $key,
                    'name' => $cartItem['product']->name,
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['product']->price,
                ]);

                $product->stock -= $cartItem['quantity'];
                $product->save();
            }

            CartService::clearCart();

            Verbs::unlessReplaying(function () {
                \Mail::to('foo@liowebdesign.com')->queue(new \App\Mail\OrderPlaced());

                Notification::make()
                    ->title('Order placed successfully')
                    ->body("You order needs to be approved, you'll be notified by email when it's approved.")
                    ->persistent()
                    ->success()
                    ->send();
            });
        } catch (\Exception $e) {
            Notification::make()
                ->title('Order failed to be placed')
                ->body('An error occurred while trying to place the order. Try again later or contact support')
                ->danger()
                ->send();
        }
    }
}
