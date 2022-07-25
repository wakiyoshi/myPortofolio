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
    public function index()
    {
        return UserResource::collection(User::all());
    }
    public function userMessageShow(){
        $user_id = Auth::id();
        $messages = Message::where("admin_id",1)
        ->where("user_id",$user_id)
        ->orderBy('created_at','asc')
        ->get();
        return $messages;
    }

    public function userMessageCreate(Request $request){

        $user_id = Auth::id();
        Message::create([
            'admin_id'=> 1,
            'user_id' => $user_id,
            'user_message'=>$request->text,
        ]);
        return response()->json(['message' => 'Users message sent successfully'], 200);
    }
    public function paymentConfirm(Request $request)
    {

         User::where("id",Auth::id())->update([
             "name" => $request->name,
             "name_kana" => $request->kana,
             "email" => $request->email,
             "phone_number" => $request->phone,
             "shipping_address" => $request->address,
             "card_number" => $request->cardNumber,
             "card_name" => $request->cardName,
             "expiration_date" => $request->expiration,
             "cvc" => $request->cvc,
        ]);

    }

}
