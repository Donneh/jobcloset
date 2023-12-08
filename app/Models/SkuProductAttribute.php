<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkuProductAttribute extends Model
{
    use HasFactory, BelongsToTenant;

    protected $table = 'sku_product_attribute';

    protected $fillable = [
        'product_attribute_id',
        'sku_id',
        'tenant_id',
        'value'
    ];

    public function productAttribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class);
    }
}
