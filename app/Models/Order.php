<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use BelongsToTenant;
    protected $fillable = [
        'number',
        'payment_method',
        'payment_status',
        'payment_reference',
        'status',
        'tenant_id',
        'user_id',
    ];

    public function getTotal()
    {
        if (!$this->relationLoaded('orderItems')) {
            $this->load('orderItems');
        }

        return $this->orderItems->reduce(function ($total, $orderItem) {
            return $total + ($orderItem->price * $orderItem->quantity);
        }, 0);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
