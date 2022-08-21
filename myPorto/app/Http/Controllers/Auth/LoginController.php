<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller
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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Login successful'], 200)
            ;

        }

        return response()->json(['message' => 'User not found'], 422);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['message' => 'Admin Login successful'], 200);
        }
        return response()->json(['message' => 'Administrator not found'], 422);
        }
        public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        return response()->json(['message' => 'Admin Logged out'], 200);

    }








}
