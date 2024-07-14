<?php

use Illuminate\Http\Request;
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

Route::post('products',function(){
    return 'Post Products';
});

Route::get('products',function(){
    return 'Get Products';
});

Route::get('products/{id}',function($id){
    return 'Get Products '. $id;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
