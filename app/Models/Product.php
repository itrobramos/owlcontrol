<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    public function thematic(){
        return $this->belongsTo(Thematic::class,'thematicId','id');
    }

    public function type(){
        return $this->belongsTo(ProductType::class,'productTypeId','id');
    }
   
    public function entriesDetails(){
        return $this->hasMany(EntryDetail::class,'productId','id');
    }

    public function expiryControl(){
        return $this->hasMany(ExpiryControl::class,'productId','id');
    }

}
