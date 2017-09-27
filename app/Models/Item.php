<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model implements Buyable
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getBuyableDescription($options = null)
    {
        return $this->style->name . $this->category->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->style->price;
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
}
