<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function store($product_id)
    {
        Auth::user()->favorite($product_id);
        return 'Favorite Stored';

    }

    public function destroy($product_id)
    {
        Auth::user()->unfavorite($product_id);
        return 'Favorite Destroyed';
    }
    public function hasFavorite($product_id)
    {
        return Auth::user()->isFavorite();
    }
}
