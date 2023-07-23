<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Money implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return \Brick\Money\Money::ofMinor($attributes['price'], $attributes['currency']);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if($value instanceof \Brick\Money\Money) {
            return $value->getMinorAmount()->toInt();
        }

        return $value;
    }
}
