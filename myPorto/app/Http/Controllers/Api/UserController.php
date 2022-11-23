<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;


class UserController extends Controller
{
    //
    public function userInformation(){
        $query = Auth::guard('sanctum')->user();
        return $query;
    }
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function paymentConfirm(Request $request)
    {
        $information = $this->validate($request,[
            'name' => 'required|string|max:20',
            'name_kana' => $request->kana,
            'shipping_address' => '',
            'email' =>  'required|email|max:255',
            'phone_number' => 'nullable|integer|digits_between:9,13',
            'card_number' => 'nullable|integer|digits:16',
            'card_name' =>'nullable|string|max:255',
            'expiration_date' => 'nullable|integer|digits:4',
            'cvc' => 'nullable|integer|digits:3',
        ],[

        ]);
         User::where('id',Auth::guard('sanctum')->user()->id)->update([
             'name' => $information['name'],
             'name_kana' => $request['name_kana'],
             'shipping_address' => $request->address,
             'email' => $request->email,
             'phone_number' => $request->phone,
             'card_number' => $request->cardNumber,
             'card_name' => $request->cardName,
             'expiration_date' => $request->expiration,
             'cvc' => $request->cvc,
        ]);
    }
    public function userUpdate(Request $request){

        $information = $this->validate($request,[
            'name' => 'required|string|max:20',
            'email' =>  'required|email|max:255',
            'shipping_address' => '',
            'phone_number' => 'nullable|integer|digits_between:9,13',
            'card_number' => 'nullable|integer|digits:16',
            'expiration_date' => 'nullable|integer|digits:4',
            'card_name' =>'nullable|string|max:255',
            'cvc' => 'nullable|integer|digits:3',
        ],
        [
            'name.required' => '名前を入力してください。',
            'name.string' => '名前は半角英数字のみでは登録できません。',
            'name.max' => '名前は20文字以下で入力してください。',

            'email.required' =>'メールアドレスを入力してください。',
            'email.email' =>'有効なメールアドレスを入力してください。',
            'email.max' =>'登録できるメールアドレスの最大文字数は255文字までです',

            'phone_number.integer' => '電話番号は半角数字で入力してください',
            'phone_number.digits_between' => '電話番号は9-13文字以内で入力してください',

            'card_number.integer' => '番号を半角英数字のみで入力してください。',
            'card_number.digits' => '番号を16ケタで入力してください。',


            'expiration_date.integer' => '有効期限を半角数字のみの4ケタで入力してください。',
            'expiration_date.digits' => '有効期限を半角数字のみの4ケタで入力してください。',

            'card_name.max' => 'クレジットカードの名義は255文字以内で入力してください。',
            'card_name.string' => 'クレジットカードの名義を英語で入力してください。',
            'cvc.digits' => '3ケタの半角数字で入力してください。',

        ]
    );


        User::where('id',Auth::guard('sanctum')->user()->id)->update([
            'name' => $information['name'],
            'email' => $information['email'],
            'shipping_address' => $information['shipping_address'],
            'phone_number' => $information['phone_number'],
            'card_number' => $information['card_number'],
            'expiration_date' => $information['expiration_date'],
            'card_name' => $information['card_name'],
            'cvc' => $information['cvc'],
        ]);
        return response()->json(['message' => 'User information was updated successfully'], 200);

    }

}
