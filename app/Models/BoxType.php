<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxType extends Model
{
    use SoftDeletes;
    protected $table =  "box_types";

   
}
