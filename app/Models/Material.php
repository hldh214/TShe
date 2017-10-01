<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Material extends Model
{
    use SoftDeletes;

    protected $appends = ['full_uri'];

    public function material_type()
    {
        return $this->belongsTo(MaterialType::class);
    }

    public function getFullUriAttribute()
    {
        return Storage::disk('admin')->url($this->uri);
    }
}
