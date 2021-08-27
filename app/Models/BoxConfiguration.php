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
   
}
