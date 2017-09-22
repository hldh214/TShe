<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;

    public function material_type()
    {
        return $this->belongsTo(MaterialType::class);
    }
}
