<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLogin;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('login/google',[UserLogin::class, 'RedirectToProvider']);
Route::post('login/google/callback',[UserLogin::class, 'HandleCallback']);
Route::get('user',[UserLogin::class,'user_email'])->middleware('auth:api');
Route::get('unauthorize',[UserLogin::class,'unauthorize'])->name('login');
Route::middleware('auth:api')->get('check_token',[UserLogin::class,"checkToken"]);
Route::middleware('auth:api')->post("profile",[UserLogin::class,'profile']);
Route::middleware('auth:api')->post("logout",[UserLogin::class,'logout']);