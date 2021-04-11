<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTagPrice extends Model
{
    use SoftDeletes;

    protected $table = 'products_tags_prices';

        


}
