<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class CartController extends Controller
{
    public function store($product_id)
    {
        Cart::create([
            'user_id' => Auth::guard('sanctum')->id(),
            'product_id' => $product_id
        ]);
        return $product_id;
    }

    public function destroy($product_id)
    {
        $user_id = Auth::guard('sanctum')->id();
        Cart::where('user_id',$user_id)->where('product_id',$product_id)->delete();

        return $user_id ;
    }

    public function cart()
    {
         $user = Auth::guard('sanctum')->user()->cart()->pluck('product_id')->toArray();
         return $user;
    }
    public function getCartProducts()
    {
         $user = Auth::guard('sanctum')->user();
         $cartProducts = $user->cart()->get();

         return $cartProducts;
    }
}
