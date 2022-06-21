<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\GoogleLoginController;




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


// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/tests', [UserController::class,'index']);


// Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);

// Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
// Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);


