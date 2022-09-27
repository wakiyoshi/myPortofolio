<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name_kana',
        'phone_number',
        'shipping_address',
        'card_number',
        'card_name',
        'expiration_date',
        'google_id',
        'github_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function favorites(){
        return $this->belongsToMany('App\Models\Product','favorites','user_id','product_id');
    }
    public function favorite($product_id) {
        $exist = $this->isFavorite($product_id);
        if($exist){
            return false;
        }else{
            $this->favorites()->attach($product_id);
            return true;
        }
    }
    public function unfavorite($product_id) {
        $exist = $this->isFavorite($product_id);
        if($exist){
            $this->favorites()->detach($product_id);
            return true;
        }else{
            return false;
        }
    }
    public function isFavorite($product_id)
    {
        return $this->favorites()->where('product_id',$product_id)->exists();
    }

    public function cart(){
        return $this->belongsToMany('App\Models\Product','carts','user_id','product_id');
    }

    public function sendPasswordResetNotification($token)
{
    $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
}

}
