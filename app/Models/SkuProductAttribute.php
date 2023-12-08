<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuProductAttribute extends Model
{
    use HasFactory, BelongsToTenant;

    protected $table = 'sku_product_attribute';
}
