<?php

namespace App\Models;

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
    ];

    public function getImagePathAttribute($value): string
    {
        return \Storage::url($value);
    }

    public function skus(): HasMany
    {
        return $this->hasMany(Sku::class);
    }

    public function productAttributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
