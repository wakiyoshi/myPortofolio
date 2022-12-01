<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Storage;

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
    public function sortProduct(Request $request)
    {
        // if($request->sort == "新着順"){
        // $request->rule
            $rules = $request->rule;
        // }
        return Product::all();
    }

    public function deleteAdminProduct($id){
        Product::where("id",$id)
        ->delete();
        return response()->json(['message' => 'Admin product was deleted successfully'], 200);
    }

    public function productCreate(Request $request){


        $products = $this->validate($request,[
            'name' => 'required|max:50',
            'category' => 'required|numeric|between:0,20',
            'price' => 'required|numeric|digits_between:1,10',
            'material' => 'max:50|string',
            'size' => 'max:50|string',
            'information' => 'required|max:200',
            'quantity' => 'required|numeric|digits_between:1,3',
            'image1' => 'required|file|image|mimes:jpeg,png,jpg,gif',
            'image2' => 'nullable|file|image|mimes:jpeg,png,jpg,gif',
            'image3' => 'nullable|file|image|mimes:jpeg,png,jpg,gif',
            'image4' => 'nullable|file|image|mimes:jpeg,png,jpg,gif',
            'image5' => 'nullable|file|image|mimes:jpeg,png,jpg,gif',
            'image6' => 'nullable|file|image|mimes:jpeg,png,jpg,gif',
            'imageName1' => '',
            'imageName2' => '',
            'imageName3' => '',
            'imageName4' => '',
            'imageName5' => '',
            'imageName6' => '',


        ],[
            'name.required' => '名前を入力してください。',
            'name.max' => '名前は50文字以内で入力してください。',

            'category.required' => 'カテゴリーIDを入力してください。',
            'category.numeric' => 'カテゴリーIDは半角数字の1-20で入力してください。',
            'category.between' => 'カテゴリーIDは半角数字の1-20で入力してください。',

            'price.required' =>  '価格を入力してください。',
            'price.numeric' =>  '価格は半角数字入力してください。',
            'price.digits_between' =>  '価格は10ケタ以下で入力してください。',

            'material.max' => '素材は50文字以内で入力してください。',
            'material.string' => '素材は文字列で入力してください。',

            'size.max' => 'サイズは50文字以内で入力してください。',
            'size.string' => 'サイズは数字を含む文字列で入力してください。',

            'information.required' => '商品説明を入力してください。',
            'information.max' => '商品説明は200文字以内で入力してください。',

            'quantity.required' => '数量を入力してください。',
            'quantity.numeric' => '数量を半角英数字で入力してください。',
            'quantity.digits_between' => '数量の上限は999です。',

            'image1.required' => '画像1を登録してください',
            'image1.mimes' =>'画像1をjpeg,png,jpg,gifのいずれかのファイル形式で登録してください。',
            'image2.mimes' =>'画像2をjpeg,png,jpg,gifのいずれかのファイル形式で登録してください。',
            'image3.mimes' =>'画像3をjpeg,png,jpg,gifのいずれかのファイル形式で登録してください。',
            'image4.mimes' =>'画像4をjpeg,png,jpg,gifのいずれかのファイル形式で登録してください。',
            'image5.mimes' =>'画像5をjpeg,png,jpg,gifのいずれかのファイル形式で登録してください。',
            'image6.mimes' =>'画像6をjpeg,png,jpg,gifのいずれかのファイル形式で登録してください。',

        ]);
        // $file_name = $request->image1->getClientOriginalName();
        // $request->image1->storeAs('public/img',$file_name);
        $image = $request->image1;

        $path = Storage::disk('s3')->putFile('myinterigentbucket',$image,'public');

        $storage_path1 = Storage::disk('s3')->url($path);

        if(isset($request->image2)){
            $image = $request->image2;
            $path = Storage::disk('s3')->putFile('myinterigentbucket',$image,'public');
            $storage_path2 = Storage::disk('s3')->url($path);
        }else{
            $storage_path2 = null;
        }
        if(isset($request->image3)){
            $image = $request->image3;
            $path = Storage::disk('s3')->putFile('myinterigentbucket',$image,'public');
            $storage_path3 = Storage::disk('s3')->url($path);
        }else{
            $storage_path3 = null;
        }
        if(isset($request->image4)){
            $image = $request->image4;
            $path = Storage::disk('s3')->putFile('myinterigentbucket',$image,'public');
            $storage_path4 = Storage::disk('s3')->url($path);
        }else{
            $storage_path4 = null;
        }
        if(isset($request->image5)){
            $image = $request->image5;
            $path = Storage::disk('s3')->putFile('myinterigentbucket',$image,'public');
            $storage_path5 = Storage::disk('s3')->url($path);
        }else{
            $storage_path5 = null;
        }
        if(isset($request->image6)){
            $image = $request->image6;
            $path = Storage::disk('s3')->putFile('myinterigentbucket',$image,'public');
            $storage_path6 = Storage::disk('s3')->url($path);
        }else{
            $storage_path6 = null;
        }
        Product::create([
            "name" => $products['name'],
            "category_id" => $products['category'],
            "price" => $products['price'],
            "material" => $products['material'],
            "size" => $products['size'],
            "information" => $products['information'],
            "quantity" => $products['quantity'],
            "image1" => $storage_path1,
            "image2" => $storage_path2,
            "image3" => $storage_path3,
            "image4" => $storage_path4,
            "image5" => $storage_path5,
            "image6" => $storage_path6,
        ],
    );



        return response()->json(['message' => '商品情報が正常に登録されました。'], 200);

    }








}

