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

// Route for posts and categories show
Route::group(['middleware'=>'api','prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1'],function(){
        Route::get('/posts','PostController@index');
        Route::get('/posts/{post}','PostController@show');
        Route::get('/categories','CategoryController@index');
        Route::get('/categories/{category}','CategoryController@show');
});

// Route for v1/auth
Route::group(['middleware'=>'api', 'prefix'=>'v1/auth','namespace'=>'App\Http\Controllers\Api\V1'], function (){
    Route::post('/login','UserController@login');
    Route::post('/register','UserController@register');
    Route::post('/logout','UserController@logout');

    // Route for auth middleware api
    Route::group(['middleware'=>'auth:api'],function (){
        Route::post('/post/like/{post}','PostController@like');
        Route::post('/comments/store','CommentController@store');
        Route::put('/change/password','UserController@changePassword');
        Route::get('/profile','UserController@profile');
        Route::post('/refresh','UserController@refreshToken');

        //Route for access level Admin
        Route::group(['middleware'=>'isAdmin','prefix'=>'panel'],function (){
              Route::resource('/users','UserController');
              Route::resource('/posts','PostController');
              Route::resource('/categories','CategoryController');
          });

    });


});


