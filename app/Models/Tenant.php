<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function jobTitles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobTitle::class);
    }
}
