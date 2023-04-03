<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use InterventionImage;
use App\Services\ProductService;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(15);

        return response()->json($products);
    }
    public function getProduct($id)
    {
        $products = Product::find($id);

        return response()->json($products);
    }

    public function search(Request $request)
    {
        $query = Product::where('name', 'like',"%".$request->keyword."%")->paginate(15);

        return $query;
    }
    public function categorySearch()
    {
        return Category::all();
    }
    public function categorySearchProduct(Request $request)
    {
        $query = Product::where('category_id', '=', $request->id)->paginate(15);
        return $query;
    }
    public function sortProduct(ProductService $product_service,Request $request)
    {
        $query = $product_service->productSort($request);

        return response()->json($query);
    }

    public function deleteAdminProduct($id){
        Product::where("id",$id)
        ->delete();
        return response()->json(['message' => 'Admin product was deleted successfully'], 200);
    }

    public function productCreate(ProductService $product_service,Request $request){

        $product_service->productCreate($request);
        return response()->json(['message' => '商品情報が正常に登録されました。'], 200);

    }








}

