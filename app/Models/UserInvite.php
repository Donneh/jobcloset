<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvite extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'email',
        'token',
    ];
}
