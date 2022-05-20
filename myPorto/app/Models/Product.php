<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id',
                           'name',
                           'price',
                           'quantity',
                           'size',
                           'information',
                           'material',
                           'is_selling',
                           'image1',
                           'image2',
                           'image3',
                           'image4',
                           'image5',
                           'image6',
                           'category_id'];

    public function favorites() {
        return $this->belongsToMany('App\Models\Favorite');
    }

    public function cart() {
        return $this->belongsTo('App\Models\Cart');
    }

    public function category()
    {
    return $this->belongsTo('App\Models\Category','id','category_id');
    }

}
