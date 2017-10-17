<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Gift extends Model
{
    use SoftDeletes;

    public function getImageUriAttribute()
    {
        return Storage::disk('admin')->url($this->image);
    }
}
