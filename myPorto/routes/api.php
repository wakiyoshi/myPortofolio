<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminAuth\AdminLoginController;
use App\Http\Controllers\AdminAuth\AdminMessageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Api\UserMessageController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\GithubLoginController;

Route::get('/user', function(Request $request){
    return $request->user();
})->middleware(['auth:sanctum','abilities:users']);

Route::get('/admin', function(Request $request){
    return $request->user();
})->middleware(['auth:sanctum','abilities:admins']);

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::get('/google/login', [GoogleLoginController::class, 'redirectToProvider']);
Route::get('/google/callback', [GoogleLoginController::class, 'handleProviderCallback']);

Route::get('/github/login', [GithubLoginController::class, 'redirectToProvider']);
Route::get('/github/callback', [GithubLoginController::class, 'handleProviderCallback']);

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout']);
    Route::post('/message/create', [AdminMessageController::class,'messageCreate']);
    Route::get('/message',[AdminMessageController::class,'messageIndex']);
    Route::get('/message/{id}',[AdminMessageController::class,'messageShow']);
    Route::get('/message/user/{id}',[AdminMessageController::class,'getMessageUser']);

});

Route::get('/user/information', [UserController::class,'userInformation']);

Route::post('/password/request',[ForgotPasswordController::class,'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'resetPassword']);


Route::post('/search', [ProductController::class,'search']);
Route::get('/category', [ProductController::class,'categorySearch']);


Route::post('/product/sort', [ProductController::class,'sortProduct']);
Route::get('/product', [ProductController::class,'index']);
Route::post('/product/{id}', [ProductController::class,'getProduct']);





Route::get('/tests', [UserController::class,'index']);

Route::post('/payment/confirm',[UserController::class,'paymentConfirm']);

Route::post('admin/product/create', [ProductController::class,'productCreate']);
Route::delete('/admin/product/delete/{id}', [ProductController::class,'deleteAdminProduct']);

Route::post('/category/product', [ProductController::class,'categorySearchProduct']);

Route::post('/change/info', [UserController::class,'userUpdate']);

Route::post('/favorites/{id}',[FavoriteController::class,'store']);
Route::post('/unfavorites/{id}',[FavoriteController::class,'destroy']);
Route::get('/hasfavorites',[FavoriteController::class,'hasFavorite']);
Route::get('/favorites/product',[FavoriteController::class,'getFavoriteProducts']);

Route::post('/cart/store/{id}',[CartController::class,'store']);
Route::post('/cart/destroy/{id}',[CartController::class,'destroy']);
Route::get('/cart',[CartController::class,'cart']);
Route::get('/cart/product',[CartController::class,'getCartProducts']);

Route::apiResource('message',UserMessageController::class);
