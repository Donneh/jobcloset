<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\States\OrderState;
use Exception;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class OrderDeclined extends Event
{
    #[StateId(OrderState::class)]
    public int $orderId;


    public function __construct(int $orderId)
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
                throw new Exception('Cannot decline a completed order');
            case OrderStatus::DECLINED:
                throw new Exception('Cannot decline a declined order');
        }
    }

    public function apply(OrderState $state): void
    {
        $state->status = OrderStatus::DECLINED;
    }


    public function handle(): void
    {
        Order::find($this->orderId)
            ->update([
                'status' => OrderStatus::DECLINED
            ]);
    }
}
