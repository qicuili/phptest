<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
foreach (['en', 'es', 'ja', 'ko', 'zh-CN'] as $lang) {
   Route::group(['prefix' => $lang], function () {
      Route::get('/', [HomeController::class, 'home']);
      Route::get('/object-deletion', [HomeController::class, 'delete']); //物件删除页面
      Route::get('/draw-similarities', [HomeController::class, 'redraw']); //物件删除页面
   });
}
Route::get('/login', [LoginController::class, 'index']);
Route::get('/login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/callback/login', [LoginController::class, 'loginCallback']);
// admin
Route::get('/admin', [AdminController::class, 'index']);
