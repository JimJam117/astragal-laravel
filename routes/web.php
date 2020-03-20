<?php

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

// Route::get('/api/posts', 'PostController@index_api');
// Route::get('/api/post/{post}', 'PostController@show_api');
// Route::get('/api/search/{search}', 'SearchController@show_api');

Route::get('/{path?}', function () {
    return view('home');
})->where('path', '.*');


// Route::get('/github', function () {
//     return redirect('https://github.com/jimjam117');
// });

// Route::get('/register', function () {
//     return redirect('/home');
// });

// Auth::routes();

// // Search
// Route::post('/search', 'SearchController@fetch');
// Route::get('/search/{search}', 'SearchController@show')->name('search');

// // Post
// Route::get('/post/create', 'PostController@create')->middleware('auth');
// Route::get('/posts', 'PostController@index');
// Route::get('/blog', 'PostController@index');
// Route::get('/post/', 'PostController@index');
// Route::post('/post', 'PostController@store')->middleware('auth');
// Route::get('/post/{post}', 'PostController@show');

// Route::get('/post/{post}/edit', 'PostController@edit')->middleware('auth');
// Route::put('/post/{post}', 'PostController@update')->middleware('auth');

// Route::get('/post/{post}/delete-confirm', 'PostController@delete_confirm')->middleware('auth');
// Route::delete('/post/{post}', 'PostController@destroy')->middleware('auth');


// // Category
// Route::get('/category/create', 'CategoryController@create')->middleware('auth');
// Route::get('/categories', 'CategoryController@index');
// Route::get('/blog/projects', 'CategoryController@index');
// Route::get('/projects', 'CategoryController@index');
// Route::post('/category', 'CategoryController@store')->middleware('auth');
// Route::get('/category/{category}', 'CategoryController@show');
// Route::get('/category/', 'CategoryController@index');

// Route::get('/category/{category}/edit', 'CategoryController@edit')->middleware('auth');
// Route::put('/category/{category}', 'CategoryController@update')->middleware('auth');

// Route::get('/category/{category}/delete-confirm', 'CategoryController@delete_confirm')->middleware('auth');
// Route::delete('/category/{category}', 'CategoryController@destroy')->middleware('auth');

// Route::get('/backend', 'BackendController@index')->name('backend')->middleware('auth');
// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/contact', 'ContactController@index')->name('contact');
// Route::post('/contact', 'ContactController@send');
// Route::get('/email', function() {
//     return view('email');
// });

// Route::get('/portfolio', function () { return view('portfolio');})->name('portfolio');

