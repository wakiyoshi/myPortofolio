<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'provider',
        'account_id',
    ];


}
