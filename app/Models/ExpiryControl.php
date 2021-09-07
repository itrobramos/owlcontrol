<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpiryControl extends Model
{
    protected $table =  "expiry_controls";
    
    public function product(){
        return $this->belongsTo(Product::class,'productId','id');
    }
}
