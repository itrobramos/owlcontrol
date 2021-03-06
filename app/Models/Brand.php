<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    public function priceTags(){
        return $this->hasMany(PriceTag::class,'brandId','id');
    }
}
