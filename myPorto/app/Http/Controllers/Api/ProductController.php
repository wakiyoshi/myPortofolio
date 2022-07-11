<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    //
    public function index()
    {
        return Product::all();
    }
    public function search(Request $request)
    {
        $query = Product::where('name', 'like',"%".$request->content."%")
        // ->orWhere('information', 'like',"%".$request."%")
        ->get();


        return $query;
    }
    public function categorySearch()
    {
        return Category::all();
    }
    public function categorySearchProduct(Request $request)
    {
        $query = Product::where('category_id', '=', $request->id)
        ->get();


        return $query;
    }


}

