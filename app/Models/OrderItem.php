<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'name',
        'price',
        'order_id',
        'quantity',
    ];

    protected $attributes = [
        'price' => 0,
    ];

    protected $casts = [
        'price' => Money::class
    ];

}
