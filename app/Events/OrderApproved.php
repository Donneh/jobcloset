<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\PaymentService;
use App\States\OrderState;
use Exception;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;
use Thunk\Verbs\Facades\Verbs;

class OrderApproved extends Event
{
    #[StateId(OrderState::class)]
    public int $orderId;

    public Order $order;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @throws Exception
     */
    public function validate(OrderState $state): void
    {
        switch ($state->status) {
            case OrderStatus::COMPLETED:
                throw new Exception('Cannot approve a completed order');
            case OrderStatus::DECLINED:
                throw new Exception('Cannot approve a declined order');
            case OrderStatus::APPROVED:
                throw new Exception('Cannot approve a approved order');
            case OrderStatus::CANCELLED:
                throw new Exception('Cannot approve a cancelled order');
        }
    }

    public function apply(OrderState $state): void
    {
        $state->status = OrderStatus::APPROVED;
    }

    public function handle(): void
    {
        $this->order = Order::find($this->orderId);
        $this->order->status = OrderStatus::APPROVED;
        $this->order->save();

        Verbs::unlessReplaying(function () {
            if($this->order->getTotal() > 0) {
                $paymentService = new PaymentService();
                $paymentLink = $paymentService->createPaymentLinkRequest($this->order);


                \Mail::to($this->order->user->email)
                    ->queue(new \App\Mail\OrderApproved($paymentLink));
            } else {
                \Mail::to($this->order->user->email)
                    ->queue(new \App\Mail\OrderApproved());
            }
        });
    }
}
