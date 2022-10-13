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
use App\Http\Controllers\Api\UserMessageController;

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



    // Route::get('/user', function(Request $request){
    //     return $request->user();
    // })->middleware(['auth:sanctum','abilities:users']);

    // Route::get('/admin', function(Request $request){
    //     return $request->user();
    // })->middleware(['auth:sanctum','abilities:admins']);

    Route::get('/user/info', [LoginController::class,'userInfo']
    )->middleware(['auth:sanctum','abilities:user']);

    Route::get('/admin/info', [AdminLoginController::class,'adminInfo']
    )->middleware(['auth:sanctum','abilities:admin']);

// Route::middleware('auth:admins')->get('admin/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::post('/register',[RegisterController::class,'register'])->name('register');


//google social login
Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);
//github social login
Route::get('/github/login', [GithubLoginController::class, 'getGithubAuth']);
Route::get('/login/github/callback', [GithubLoginController::class, 'authGithubCallback']);

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login');
    Route::post('/logout', [AdminLoginController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/message/create', [AdminMessageController::class,'messageCreate']);
    Route::get('/message',[AdminMessageController::class,'messageIndex']);
    Route::post('/message/{id}',[AdminMessageController::class,'messageShow']);
});




Route::get('/user/information', [UserController::class,'userInformation']);


Route::post('/reset-password',[ForgotPasswordController::class,'sendResetLinkEmail']);


Route::post('/reset/password', [ForgotPasswordController::class,'callResetPassword']);

Route::post('/search', [ProductController::class,'search']);
Route::get('/category', [ProductController::class,'categorySearch']);

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



















