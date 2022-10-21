<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\UserSocial;


class GoogleLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->redirect()->getTargetUrl();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $userSocial = UserSocial::firstOrNew([
            'provider' => 'google',
            'account_id' => $googleUser->getId(),
        ]);
        if ($userSocial->exists) {
            $user = User::find($userSocial->getAttribute('user_id'));
        }else{
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => null,

            ]);
            $userSocial->setAttribute('user_id',$createUser->id);
            $socialAccount->save();
        }
        return[
            'user' => $user,
            'access_token'=> $user->createToken(null,['*'])->accessToken,
        ];
        }

}

