<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Carousel extends Model
{
    use SoftDeletes;

    public function getFullUriAttribute()
    {
        return Storage::disk('admin')->url($this->uri);
    }
}
