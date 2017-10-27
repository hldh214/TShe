<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Story extends Model
{
    use SoftDeletes;

    protected $casts = [
        'images' => 'array'
    ];

    public function getAvatarUriAttribute()
    {
        return Storage::disk('admin')->url($this->avatar);
    }

    public function getImagesUriAttribute()
    {
        $ret = [];
        foreach ($this->images as $image) {
            $ret[] = Storage::disk('admin')->url($image);
        }

        return $ret;
    }
}
