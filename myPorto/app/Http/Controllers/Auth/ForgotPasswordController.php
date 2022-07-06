<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'パスワード再設定メールを送信しました', 'status' => true], 201)
            : response()->json(['message' => 'パスワード再設定メールを送信できませんでした。', 'status' => false], 401);
    }

//     protected function sendResetLinkResponse(Request $request, $response)
// {
//     return response()->json([
//         'message' => 'Password reset email sent.',
//         'data' => $response
//     ]);
// }

//     protected function sendResetLinkFailedResponse(Request $request, $response)
//     {
//         return response()->json(['message' => 'Email could not be sent to this email address.']);
//     }

//     protected function resetPassword($user, $password)
//     {
//         $user->password = Hash::make($password);
//         $user->save();
//         event(new PasswordReset($user));
//     }
// }

}
