<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;



class GithubLoginController extends Controller
{
    public function getGithubAuth()
    {
        return Socialite::driver('github')
            ->redirect();
    }

    public function authGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            $finduser = User::where("github_id", $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect("user/home");
            } else {
                $newUser = User::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "github_id" => $user->id,
                    "password" => encrypt("123456dummy"),
                ]);
                Auth::login($newUser);
                return redirect("user/home");
            }
        } catch (Exception $e) {
            \Log::error($e);
            

        }
    }
}


