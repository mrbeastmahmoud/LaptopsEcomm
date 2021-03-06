<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\AuthController;
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

//Route::get('/',[\App\Http\Controllers\ProductController::class,'getIndexx']);

Route::group(['namespace' => 'App\Http\Controllers'],function (){
    Route::get('/',[ProductController::class,'getIndex']);
    Route::get('/login',[AuthController::class,'getLoginForm']);
    Route::post('/login',[AuthController::class,'postLogin']);
    Route::get('/signup',[AuthController::class,'getSignup']);
    Route::post('/user/register',[AuthController::class,'register']);
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/add',[\App\Http\Controllers\FavoritesControoller::class,"addtocart"]);
    Route::get('/load-cart-data',[\App\Http\Controllers\FavoritesControoller::class,"cartload"]);
    Route::get('/favorite',[\App\Http\Controllers\FavoritesControoller::class,"index"]);
Route::get('/clearFavorite',[\App\Http\Controllers\FavoritesControoller::class,"Clear"]);
});
Route::group(['prefix' => '/product/{product}'],function (){
    Route::get('',[ProductController::class,'getProductView']);

});



