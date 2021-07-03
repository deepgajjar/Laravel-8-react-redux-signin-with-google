<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLogin;
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

Route::view('/{path?}', 'welcome');
Route::get('/', function () {
    return view('welcome');
});

// Route::get('login/google',[UserLogin::class, 'RedirectToProvider']);
// Route::get('login/google/callback',[UserLogin::class, 'HandleCallback']);
// Route::get('user',[UserLogin::class,'user_email'])->middleware('auth:api');
// Route::get('unauthorize',[UserLogin::class,'unauthorize'])->name('login');
