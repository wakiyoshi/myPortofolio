<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Message extends Model
{
    use HasFactory;


    protected $fillable = ['user_id'
                          ,'admin_id'
                          ,'admin_message'
                          ,'user_message'];

    protected $guarded = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','id','user_id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin','id','admin_id');
    }
    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i');
    }
}
