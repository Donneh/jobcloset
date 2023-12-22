<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id'
    ];

    public function jobTitles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobTitle::class);
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function adyenSettings(): HasOne
    {
        return $this->hasOne(AdyenSettings::class);
    }
}
