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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'Api\PostController@index');
Route::get('/posts/try_it', 'Api\PostController@randomPosts');
Route::get('/post/{id}', 'Api\PostController@show')->middleware('api.auth');

Route::get('/contacts', 'Api\ContactController@index');