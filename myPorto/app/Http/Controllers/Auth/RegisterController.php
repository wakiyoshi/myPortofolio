<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{


    protected function register (Request $request)
    {
        $information = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        return User::create([
            'name' => $information['name'],
            'email' => $information['email'],
            'password' => Hash::make($information['password']),
        ]);
    }
}
