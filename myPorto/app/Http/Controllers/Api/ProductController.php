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
        $products = Product::paginate(30);

        return response()->json($products);
    }
    public function getProduct($id)
    {
        $products = Product::find($id);

        return response()->json($products);
    }

    public function search(Request $request)
    {
        $query = Product::where('name', 'like',"%".$request->content."%")->paginate(15);

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

    public function deleteAdminProduct($id){
        Product::where("id",$id)
        ->delete();
        return response()->json(['message' => 'Admin product was deleted successfully'], 200);
    }

    public function productCreate(Request $request){
        // dd($request->file);
        // $files = $request->file;
        foreach ( $request as $file ) {
            $file_name = $file->file->getClientOriginalName();
            $file->file->storeAs('public/img',$file_name);

        }

        // $products = $this->validate($request,[
        //     'name' => 'required|max:50',
        //     'category' => 'required|numeric|between:0,20',
        //     'price' => 'required|numeric|digits_between:1,10',
        //     'material' => 'max:50|string',
        //     'size' => 'max:50|string',
        //     'information' => 'required|max:200',
        //     'quantity' => 'required|numeric|digits_between:1,3',

        // ],[
        //     'name.required' => '名前を入力してください。',
        //     'name.max' => '名前は50文字以内で入力してください。',

        //     'category.required' => 'カテゴリーIDを入力してください。',
        //     'category.numeric' => 'カテゴリーIDは半角数字の1-20で入力してください。',
        //     'category.between' => 'カテゴリーIDは半角数字の1-20で入力してください。',

        //     'price.required' =>  '価格を入力してください。',
        //     'price.numeric' =>  '価格は半角数字入力してください。',
        //     'price.digits_between' =>  '価格は10ケタ以下で入力してください。',

        //     'material.max' => '素材は50文字以内で入力してください。',
        //     'material.string' => '素材は文字列で入力してください。',

        //     'size.max' => 'サイズは50文字以内で入力してください。',
        //     'size.string' => 'サイズは数字を含む文字列で入力してください。',

        //     'information.required' => '商品説明を入力してください。',
        //     'information.max' => '商品説明は200文字以内で入力してください。',

        //     'quantity.required' => '数量を入力してください。',
        //     'quantity.numeric' => '数量を半角英数字で入力してください。',
        //     'quantity.digits_between' => '数量の上限は999です。',
        // ]);


        // Product::create([
        //     "name" => $products['name'],
        //     "category_id" => $products['category'],
        //     "price" => $products['price'],
        //     "material" => $products['material'],
        //     "size" => $products['size'],
        //     "information" => $products['information'],
        //     "quantity" => $products['quantity'],
        //     "image1" => 'sample.png',
        //     // "image2" => $request->image2,
        //     // "image3" => $request->image3,
        //     // "image4" => $request->image4,
        //     // "image5" => $request->image5,
        //     // "image6" => $request->image6,
        // ]);

        return response()->json(['message' => '商品情報が正常に登録されました。'], 200);

    }








}

