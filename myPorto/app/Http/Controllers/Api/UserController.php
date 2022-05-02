<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = UserResource::collection(User::all());

        return view('user', compact('users'));
    }

}
