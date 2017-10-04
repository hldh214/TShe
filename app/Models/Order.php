<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $casts = [
        'coupon' => 'array',
        'item'   => 'array'
    ];

    public function getAmountAttribute($value)
    {
        return number_format($value / 100, 2);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }
}
