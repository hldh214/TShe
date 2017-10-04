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
    const status = [
        0 => '待付款',
        1 => '已付款',
        2 => '已发货'
    ];

    public function getAmountAttribute($value)
    {
        return number_format($value / 100);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function address()
    {
        return $this->belongsTo(Address::class)->withTrashed();
    }

    public function get_order_status()
    {
        return self::status[$this->status];
    }

    public function get_order_items()
    {
        return array_map(function ($each) {
            return [
                'item' => Item::find($each['item_id']),
                'size' => Style::sizes[$each['size']],
                'qty'  => $each['qty']
            ];
        }, $this->item);
    }
}
