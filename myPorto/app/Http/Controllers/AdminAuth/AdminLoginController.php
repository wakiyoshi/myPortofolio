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

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:admin')->except('adminLogout');
    // }
    public function adminInfo()
    {
        $user = Auth::user();
        return response()->json(['data' => $user]);
    }



    public function adminLogin(Request $request)
    {

        $credentials = $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $admin->tokens()->where('name', 'user-admin')->delete();
            $admin->token = $admin->createToken('user-admin')->plainTextToken;

            return response()->json(['message' => 'Admin Login successful','user'=>$admin], 200);
        }
        return response()->json(['message' => 'Administrator not found'], 422);

        }
        public function adminLogout(Request $request)
    {
        Auth::attempt()->logout();
        // $request->session()->invalidate();
        return response()->json(['message' => 'Admin Logged out'], 200);

    }








}
