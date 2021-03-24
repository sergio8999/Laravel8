<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PruebaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */


/* Route::post('register/signUp',[AuthController::class,'signUp'])->name('register.signUp');

Route::post('login/login',[AuthController::class,'login'])->name('login.login');

Route::get('information',[AuthController::class,'user'])->name('information');
Route::get('logout',[AuthController::class,'logout'])->name('logout'); */

/* Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login',[AuthController::class,'login'])->name('login.login');
    Route::post('signUp',[AuthController::class,'signUp'])->name('register.signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout',[AuthController::class,'logout'])->name('logout');
        Route::get('user',[AuthController::class,'user'])->name('user');
    });
}); */

/* Route::group(function () {
    Route::get('/', [HomeController::class])->name('home');
}); */

Route::group([  ], function() {
      Route::get('prueba',[PruebaController::class,'prueba'])->name('prueba');
      Route::post('signUp',[AuthController::class,'signUp'])->name('signUp');
      Route::post('login',[AuthController::class,'login'])->name('login');
      Route::get('user',[AuthController::class,'user'])->name('user');
      Route::get('logout',[AuthController::class,'logout'])->name('logout');
      Route::get('products', [ProductController::class, 'products'])->name('products');
  });
