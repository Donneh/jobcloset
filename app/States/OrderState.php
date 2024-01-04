<?php

namespace App\States;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use Thunk\Verbs\State;

class OrderState extends State
{
    public string $status = OrderStatus::PENDING;
}
