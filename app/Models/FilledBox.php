<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilledBox extends Model
{
    protected $table =  "filled_boxes";

    public function filledBoxDetails(){
        return $this->hasMany(FilledBoxDetail::class,'filledBoxId','id');
    }
}
