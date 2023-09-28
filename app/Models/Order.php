<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use BelongsToTenant;
    protected $fillable = [
        'number',
        'payment_method',
        'payment_status',
        'payment_reference',
        'status',
    ];

    public function getTotal()
    {
        return $this->products->reduce(function ($total, $product) {
            return $total->add($product->price->multiply($product->pivot->quantity));
        }, Money::EUR(0));
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
