<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ProductGallery;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = [];

    public function galleries(){
        return $this->hasMany(ProductGallery::class,'products_id');
    }

}
