<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(15);

        return response()->json($products);
    }
    public function search(Request $request)
    {
        $query = Product::where('name', 'like',"%".$request->content."%")
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
        // $query = Product::where('category_id', '=', $request->id)->paginate(15);
        $query = Product::paginate(30)->where('category_id', '=', $request->id);

;
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
    public function like(User $user, Product $product)
    {
        if (!$product) {
            abort(404);
        }

        //いいねは１回しか押させない
        $product->likes()->detach($user->id);
        $product->likes()->attach($user->id);

        return ['product_id' => $product->id];
    }
    public function likeIndex()
    {

        // $products = Product::all();
        // return $products->liked_by_user->paginate(15);

    }






}

