<?php

use Illuminate\Http\Request;

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

Route::resource('image', 'Api\ImageController');
Route::resource('post', 'Api\PostController');
Route::resource('category', 'Api\CategoryController');
Route::get('/post-images/{id}', 'Api\ImageController@show_images_in_post');
Route::get('/pref', function() {
    $pref = \App\Pref::first();
    return response()->json($pref);
});