<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
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

}
