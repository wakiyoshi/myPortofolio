<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class Product extends Model
{
    use HasFactory;
    protected $appends = [
        'liked_by_user',
      ];

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
    public function likes()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function getLikedByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->likes->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }


}
