<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Style extends Model
{
    use SoftDeletes;

    protected $casts = [
        'size' => 'array',
    ];
    protected $appends = ['front_uri', 'back_uri'];

    const sizes = [1 => 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parse_size()
    {
        $res = [];

        foreach ($this->size as $each_size) {
            $res[$each_size] = self::sizes[$each_size];
        }
        return $res;
    }

    public function getFrontUriAttribute()
    {
        return Storage::disk('admin')->url($this->front);
    }

    public function getBackUriAttribute()
    {
        return Storage::disk('admin')->url($this->back);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value / 100, 0);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }
}
