<?php

namespace App\Events;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\States\OrderState;
use Exception;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class OrderApproved extends Event
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
        Order::find($this->orderId)
            ->update([
                'status' => OrderStatus::APPROVED
            ]);

        // @TODO: Notify the user that their order was approved and send them an adyen payment link.

    }
}
