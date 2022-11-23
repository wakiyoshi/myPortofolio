<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\UserSocial;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Hash;


class GithubLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')
            ->redirect()->getTargetUrl();
    }

    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->stateless()->user();


        $userSocial = UserSocial::firstOrNew([
            'provider' => 'github',
            'account_id' => $githubUser->getId(),
        ]);
        if ($userSocial->exists) {

            User::find($userSocial->getAttribute('user_id'))->update([
                'name' => $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'password' => Hash::make($githubUser->getId()),
            ]);

            $user = User::find($userSocial->getAttribute('user_id'));

        }else{

            if(User::firstOrNew(['email' => $githubUser->getEmail()])->exists){
                $user = User::where('email',$githubUser->getEmail())->updateOrCreate([
                    'name' => $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'password' => Hash::make($githubUser->getId()),
                ]);
                $userSocial->setAttribute('user_id',$user->id);
                $userSocial->save();
            }else{

            $user = User::create([
                'name' => $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'password' => Hash::make($githubUser->getId()),
            ]);
            $userSocial->setAttribute('user_id',$user->id);
            $userSocial->save();
            }
        }
        $credentials = ['email' =>  $githubUser->getEmail(),'password' => $githubUser->getId()];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([ 'user' => $user, 'access_token' => $user->createToken('user-auth',['*'])->accessToken]);
        }else{
        return response()->json(['message' => 'User not found'], 422);
        }


    }
}



