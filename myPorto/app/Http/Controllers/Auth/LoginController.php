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
        $auth = false;
        $user = null;
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->tokens()->where('name', 'user-auth')->delete();
            $user->token = $user->createToken('user-auth')->plainTextToken;
            $auth = true;

            return response()->json(['message' => 'ログイン成功','user' => $user,'auth'=> $auth], 200)
            ;
        }
        return response()->json(['message' => 'メールアドレスまたはパスワードが間違っています'], 201);
    }
    public function userInfo() {
        $user = null;
        $auth = false;
        if (Auth::check()) {
            $user = Auth::user();
            $auth = true;
        }
        return response()->json(['auth' => $auth, 'user' => $user]);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200);
    }


}
