<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use SoftDeletes;

    
    public function thematic(){
        return $this->belongsTo(Thematic::class,'thematicId','id');
    }
   
}
