<?php

namespace App\Models;

use App\User;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model implements Buyable
{
    use SoftDeletes;

    protected $appends = ['front_uri', 'back_uri'];

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function style()
    {
        return $this->belongsTo(Style::class)->withTrashed();
    }

    public function color()
    {
        return $this->belongsTo(Color::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFrontUriAttribute()
    {
        return Storage::disk('admin')->url($this->front);
    }

    public function getBackUriAttribute()
    {
        return Storage::disk('admin')->url($this->back);
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
