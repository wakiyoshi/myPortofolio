<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\GithubLoginController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\FavoriteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//google social login
Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);
//github social login
Route::get('/github/login', [GithubLoginController::class, 'getGithubAuth']);
Route::get('/login/github/callback', [GithubLoginController::class, 'authGithubCallback']);

Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::prefix('admin')->group(function () {
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('admin.login');
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/message/create', [AdminController::class,'messageCreate']);

});

// Route::post('/user/message/create', [UserController::class,'userMessageCreate']);

Route::get('/products/{product}/favorites', [FavoriteController::class,'store']);
Route::get('/products/{product}/unfavorites', [FavoriteController::class,'destroy']);
Route::get('/products/{product}/hasfavorites', [FavoriteController::class,'hasFavorite']);



Route::resource('user/message', 'UserMessageController');


Route::get('{any}', function() {
         return view('app');
     })->where('any', '.*');














