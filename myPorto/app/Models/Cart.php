<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id','user_id','product_id'];

    public function user(){
        return $this->hasMany('App\Models\User','id','user_id');
    }
    public function product(){
        return $this->hasMany('App\Models\Product','id','product_id');
    }




}
