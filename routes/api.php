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
    Route::post("logout",[AuthController::class, 'logout']);

    Route::post('products',[ProductController::class,'postProducts']);
});

// Product

Route::get('products',[ProductController::class,'getAllProducts']);
Route::get('products/name', [ProductController::class, 'getProductByName']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
