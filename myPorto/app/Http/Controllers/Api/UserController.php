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
         User::where('id',Auth::guard('sanctum')->user()->id)->update([
             "name" => $request->name,
             "name_kana" => $request->kana,
             "shipping_address" => $request->address,
             "email" => $request->email,
             "phone_number" => $request->phone,
             "shipping_address" => $request->address,
             "card_number" => $request->cardNumber,
             "card_name" => $request->cardName,
             "expiration_date" => $request->expiration,
             "cvc" => $request->cvc,
        ]);
    }
    public function userUpdate(Request $request){

        User::where('id',Auth::guard('sanctum')->user()->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "shipping_address" => $request->shipping_address,
            "phone_number" => $request->phone_number,
            "card_number" => $request->card_number,
            "expiration_date" => $request->expiration_date,
            "card_name" => $request->card_name,
            "cvc" => $request->cvc,
        ]);
        return response()->json(['message' => 'User information was updated successfully'], 200);

    }

}
