<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    

    public function PriceTag(){
        return $this->belongsToMany(PriceTag::class, 'products_tags_prices', 'priceTagId', 'id')->withPivot('price');

    }

    public function Category()
    {
       return $this->belongsTo(Category::class,'categoryId','id'); 
    }

    public function Images()
    {
        return $this->hasMany(ProductImage::class, 'productId', 'id');
    }

}
