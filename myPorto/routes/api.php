<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\CartController;

use App\Http\Controllers\Auth\LoginController;



use App\Http\Controllers\Auth\ForgotPasswordController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
});

Route::get('/user/information', [UserController::class,'userInformation']);

Route::middleware('auth:admin')->get('admin/user', function (Request $request) {
    return $request->user();
});


Route::post('/reset-password',[ForgotPasswordController::class,'sendResetLinkEmail']);


Route::post('/reset/password', [ForgotPasswordController::class,'callResetPassword']);

Route::post('/search', [ProductController::class,'search']);
Route::get('/category', [ProductController::class,'categorySearch']);

Route::get('/product', [ProductController::class,'index']);
Route::post('/product/{id}', [ProductController::class,'getProduct']);

Route::get('/tests', [UserController::class,'index']);

Route::post('/payment/confirm',[UserController::class,'paymentConfirm']);

Route::prefix('admin')->group(function () {
Route::get('/message', [AdminController::class,'messageIndex']);
Route::post('/message/{id}', [AdminController::class,'messageShow']);
});

// Route::get('/user/message', [UserController::class,'userMessageShow']);

Route::post('admin/product/create', [ProductController::class,'productCreate']);
Route::delete('/admin/product/delete/{id}', [ProductController::class,'deleteAdminProduct']);

Route::post('/category-product', [ProductController::class,'categorySearchProduct']);

Route::post('/change/info', [UserController::class,'userUpdate']);


Route::post('/favorites/{id}',[FavoriteController::class,'store']);
Route::post('/unfavorites/{id}',[FavoriteController::class,'destroy']);
Route::get('/hasfavorites',[FavoriteController::class,'hasFavorite']);
Route::get('/favorites/product',[FavoriteController::class,'getFavoriteProducts']);

Route::post('/cart/store/{id}',[CartController::class,'store']);
Route::post('/cart/destroy/{id}',[CartController::class,'destroy']);
Route::get('/cart',[CartController::class,'cart']);
Route::get('/cart/product',[CartController::class,'getCartProducts']);























