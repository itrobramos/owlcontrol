<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilledBoxDetail extends Model
{
    protected $table =  "filled_boxes_details";

    public function filledBox(){
        return $this->belongsTo(FilledBox::class,'filledBoxId','id');
    }
    
    public function product(){
        return $this->belongsTo(Product::class,'productId','id');
    }
}
