<?php

namespace App\Models;

use App\Casts\Money;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'tenant_id'
    ];

    protected $attributes = [
        'stock' => 0,
        'price' => 0,
    ];

    protected $casts = [
        'price' => Money::class
    ];

    public function isFree(): bool
    {
        return $this->price == 0;
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

}
