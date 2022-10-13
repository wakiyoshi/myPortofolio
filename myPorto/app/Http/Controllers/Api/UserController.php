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
    public function userUpdate(Request $request){

        User::where('id',Auth::id())->update([
            "name" => $request->name,
            "email" => $request->email,
            "shipping_address" => $request->address,
            "phone_number" => $request->phone,
            "card_number" => $request->cardNumber,
            "expiration_date" => $request->expiration,
            "card_name" => $request->cardName,
            "cvc" => $request->cvc,
        ]);
        return response()->json(['message' => 'User information was updated successfully'], 200);

    }

}
