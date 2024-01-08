<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\States\OrderState;
use Exception;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class OrderPaid extends Event
{
    #[StateId(OrderState::class)]
    public int $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @throws Exception
     */
    public function validate(OrderState $state): void
    {
        // @TODO: Add check for pending
        switch ($state->status) {
            case OrderStatus::COMPLETED:
                throw new Exception('Cannot pay for a completed order');
            case OrderStatus::DECLINED:
                throw new Exception('Cannot pay for a declined order');
//            case OrderStatus::PENDING:
//                throw new Exception('Order must be approved before it can be paid');
        }
    }

    public function apply(OrderState $state): void
    {
        $state->status = OrderStatus::PAID;
    }


    public function handle(): void
    {
        Order::find($this->orderId)
            ->update([
                'status' => OrderStatus::PAID
            ]);
    }
}
