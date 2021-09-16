<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxConfiguration extends Model
{
    protected $table =  "configuration_boxes";

    public function thematic(){
        return $this->belongsTo(Thematic::class,'thematicId','id');
    }

    public function type(){
        return $this->belongsTo(ProductType::class,'productTypeId','id');
    }
   
    public function product(){
        return $this->belongsTo(Product::class,'productId','id');
    }

    public function entriesDetails(){
        return $this->hasMany(EntryDetail::class,'productId','id');
    }
}
