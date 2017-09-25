<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Style extends Model
{
    use SoftDeletes;

    protected $casts = [
        'size' => 'array',
    ];

    const sizes = [1 => 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value / 100, 2);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }
}
