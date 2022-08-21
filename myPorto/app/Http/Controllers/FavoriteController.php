<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function store($product_id)
    {
        Auth::user()->favorite($product_id);
        return back();

    }

    public function destroy($product_id)
    {
        Auth::user()->unfavorite($product_id);
        return back();
    }
    public function hasFavorite()
    {
        return Auth::user()->isfavorite();
    }
}
