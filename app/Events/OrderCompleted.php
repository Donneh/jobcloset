<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\States\OrderState;
use Exception;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class OrderCompleted extends Event
{
    #[StateId(OrderState::class)]
    public int $orderId;

    /**
     * @throws Exception
     */
    public function validate(OrderState $state): void
    {
        switch ($state->status) {
            case OrderStatus::COMPLETED:
                throw new Exception('Cannot complete a completed order');
            case OrderStatus::DECLINED:
                throw new Exception('Cannot complete a declined order');
            case OrderStatus::CANCELLED:
                throw new Exception('Cannot complete a cancelled order');
        }
    }

    public function apply(OrderState $state): void
    {
        $state->status = OrderStatus::COMPLETED;
    }


    public function handle(): void
    {
        Order::find($this->orderId)
            ->update([
                'status' => OrderStatus::COMPLETED
            ]);
    }
}
