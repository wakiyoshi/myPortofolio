<?php

namespace App\Http\Controllers\Api;


use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function index()
    {
        return Product::all();
    }

}

