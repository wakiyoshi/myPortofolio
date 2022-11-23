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
            'password' => 'required'
        ],[
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください',
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $admin->tokens()->where('name', 'user-admin')->delete();
            $admin->token = $admin->createToken('user-admin')->plainTextToken;
            $auth = true;

            return response()->json(['message' => '管理者ログイン成功','admin'=>$admin,'auth'=>$auth], 200);
        }
        return response()->json(['message' => '管理者情報が一致しません。'], 422);

        }
        public function logout()
    {
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'Admin Logged out'], 200);

    }








}
