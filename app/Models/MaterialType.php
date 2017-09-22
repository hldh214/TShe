<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialType extends Model
{
    use SoftDeletes;

//    protected $table = 'material_types';

    public function material()
    {
        return $this->hasMany(Material::class);
    }
}
