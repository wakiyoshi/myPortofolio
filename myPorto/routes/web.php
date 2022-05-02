<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


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


Route::get('/home',[UserController::class,'index']) ->name('home');



Route::post('/login',[LoginController::class,'login']);
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

// Route::get('/register',[RegisterController::class,'showRegistrationForm']) ->name('register');
// Route::post('/register',[RegisterController::class,'register']);


// Route::get('/product/{product}',[ProductController::class,'show']) ->name('product.show');
// Route::get('/all',[ProductController::class,'index']) ->name('all');

// Route::get('/all/{price}','ProductController@index_price')->name('price');
// Route::get('/category/{category}/','CategoryController@category')->name('category');
// Route::get('/category/{category}/{price}','CategoryController@index_category_price')->name('category_price');











// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

