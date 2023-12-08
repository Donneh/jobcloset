<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sku extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'sku',
        'price',
        'currency',
    ];

    protected $casts = [
        'price' => Money::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
