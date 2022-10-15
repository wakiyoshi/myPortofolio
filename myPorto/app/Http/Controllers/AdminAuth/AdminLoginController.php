<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    public function login(Request $request)
    {
        $admin = null;
        $auth = null;
        $credentials = $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $admin->tokens()->where('name', 'user-admin')->delete();
            $admin->token = $admin->createToken('user-admin')->plainTextToken;
            $auth = true;

            return response()->json(['message' => 'Admin Login successful','admin'=>$admin,'auth'=>$auth], 200);
        }
        return response()->json(['message' => 'Administrator not found'], 422);

        }
        public function logout()
    {
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'Admin Logged out'], 200);

    }








}
