<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'name',
        'stock',
        'description',
        'image_path',
        'price',
    ];

    protected $casts = [
        'price' => Money::class
    ];

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }
}
