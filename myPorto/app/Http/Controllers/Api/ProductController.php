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
        // ->orWhere('information', 'like',"%".$request->content."%")
        // ->orWhere('material', 'like',"%".$request->content."%")
        ->orderBy('created_at','asc')
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
    public function deleteAdminProduct($id){
        Product::where("id",$id)
        ->delete();
        return response()->json(['message' => 'Admin product was deleted successfully'], 200);
    }

    public function productCreate(Request $request){

        Product::create([
            "name" => $request->name,
            "category_id" => $request->category,
            "price" => $request->price,
            "material" => $request->material,
            "size" => $request->size,
            "information" => $request->information,
            "quantity" => $request->quantity,
            "image1" => $request->image1,
            "image2" => $request->image2,
            "image3" => $request->image3,
            "image4" => $request->image4,
            "image5" => $request->image5,
            "image6" => $request->image6,
        ]);
        return response()->json(['message' => 'Admin product was created successfully'], 200);
    }




}

