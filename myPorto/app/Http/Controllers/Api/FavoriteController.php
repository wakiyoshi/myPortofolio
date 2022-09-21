<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function store($id)
    {
         $user = Auth::guard('sanctum')->user();
         $user->favorite($id);

         return $id;
    }

    public function destroy($id)
    {

            $user = Auth::guard('sanctum')->user();
            $user->unfavorite($id);

            return $id ;
    }

    public function hasFavorite()
    {
         $user = Auth::guard('sanctum')->user()->favorites()->pluck('product_id')->toArray();

         return $user;
    }
    public function getFavoriteProducts()
    {
         $user = Auth::guard('sanctum')->user();
         $favoriteProducts = $user->favorites()->get();

         return $favoriteProducts;
    }


}
