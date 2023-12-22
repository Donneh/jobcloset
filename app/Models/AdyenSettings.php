<?php

namespace App\Models;

use App\Enums\AdyenEnvironment;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdyenSettings extends Model
{
    use BelongsToTenant;

    protected $casts = [
        'environment' => AdyenEnvironment::class,
        'adyen_api_key' => 'encrypted',
        'adyen_client_key' => 'encrypted'
    ];

    protected $fillable = [
        'environment',
        'merchant_account',
        'api_key',
        'client_key'
    ];
}
