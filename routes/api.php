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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware'=>'api','prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1'],function(){
        Route::get('/posts','PostController@index');
        Route::get('/posts/{post}','PostController@show');
        Route::get('/categories','CategoryController@index');
        Route::get('/categories/{category}','CategoryController@show');
});

Route::group(['middleware'=>'api', 'prefix'=>'v1/auth','namespace'=>'App\Http\Controllers\Api\V1'], function (){
    Route::post('/login','UserController@login');
    Route::post('/register','UserController@register');
    Route::post('/logout','UserController@logout');
    Route::post('/refresh','UserController@refresh');
    Route::get('/profile','UserController@profile');
});

