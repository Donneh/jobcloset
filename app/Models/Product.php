<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'name',
        'price',
        'currency',
        'stock',
        'description',
        'image_path',
    ];

    protected $casts = [
        'price' => Money::class,
    ];
}
