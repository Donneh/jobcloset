<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'name',
        'adyen_merchant_account',
        'adyen_api_key',
        'adyen_client_key',
    ];
}
