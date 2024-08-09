<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

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

// Authentication APIs
Route::post("register",[AuthController::class, 'register']);
Route::post("login",[AuthController::class, 'login']);


Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get("profile",[AuthController::class, 'profile']);
});

// Product
Route::post('products',[ProductController::class,'postProducts']);
Route::get('products',[ProductController::class,'getProducts']);
Route::get('products/{id}',[ProductController::class,'getProductById']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
