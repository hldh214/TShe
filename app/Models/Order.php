<?php

namespace App\Models;

use App\User;
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

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function get_gift_or_fail()
    {
        if (array_key_exists('gift_id', $this->item)) {
            return [
                'gift' => Gift::find($this->item['gift_id'])
            ];
        }

        return false;
    }

    public function save(array $options = [])
    {
        if (empty($this->out_trade_no)) {
            $this->out_trade_no = microtime(true) * 10000 . rand(100000, 999999);
            $this->user_id = auth()->id();
        }

        return parent::save($options);
    }
}
