<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;



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

    public function paymentConfirm(UserService $user_service,Request $request)
    {
        $user_service->paymentsConfirm($request);
        return response()->json(['message' => 'User payment was confirmed successfully'], 200);

    }
    public function userUpdate(UserService $user_service,Request $request){
        $user_service->usersUpdate($request);
        return response()->json(['message' => 'User information was updated successfully'], 200);

    }

}
