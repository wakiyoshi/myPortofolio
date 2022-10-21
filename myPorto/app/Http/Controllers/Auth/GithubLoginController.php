<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
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




    }
}


