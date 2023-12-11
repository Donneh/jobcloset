<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Money implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return round(floatval($value) / 100, precision: 2);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return round(floatval($value) * 100);
    }
}
