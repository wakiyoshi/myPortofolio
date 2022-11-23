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


class GoogleLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')
            ->redirect()->getTargetUrl();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $userSocial = UserSocial::firstOrNew([
            'provider' => 'google',
            'account_id' => $googleUser->getId(),
        ]);
        if ($userSocial->exists) {

            User::find($userSocial->getAttribute('user_id'))->update([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make($googleUser->getId()),
            ]);

            $user = User::find($userSocial->getAttribute('user_id'));

        }else{

            if(User::firstOrNew(['email' => $googleUser->getEmail()])->exists){
                $user = User::where('email',$googleUser->getEmail())->updateOrCreate([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make($googleUser->getId()),
                ]);
                $userSocial->setAttribute('user_id',$user->id);
                $userSocial->save();
            }else{
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make($googleUser->getId()),
            ]);
            $userSocial->setAttribute('user_id',$user->id);
            $userSocial->save();
            }
        }
        $credentials = ['email' =>  $googleUser->getEmail(),'password' => $googleUser->getId()];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([ 'user' => $user, 'access_token' => $user->createToken('user-auth',['*'])->accessToken]);
        }
        return response()->json(['message' => 'User not found'], 422);


    }
}
