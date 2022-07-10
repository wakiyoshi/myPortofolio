<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




// Send reset password mail
Route::post('/reset-password',[ForgotPasswordController::class,'sendResetLinkEmail']);

// handle reset password form process
Route::post('/reset/password', [ForgotPasswordController::class,'callResetPassword']);

Route::post('/search', [ProductController::class,'search']);
Route::get('/product', [ProductController::class,'index']);
Route::get('/tests', [UserController::class,'index']);




