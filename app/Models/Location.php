<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'name',
    ];

    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class);
    }
}
