<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function Brand()
    {
        return $this->belongsTo(Brand::class,'brandId','id');
    }
}
