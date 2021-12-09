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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/driver/posts','Driver\PostController@index');

Route::get('/driver/posts/create','Driver\PostController@create');

Route::post('/driver/posts/create','Driver\PostController@store');

Route::get('/driver/posts/{id}','Driver\PostController@show');

Route::get('/driver/posts/{id}/edit','Driver\PostController@edit');

Route::put('/driver/posts/{id}','Driver\PostController@update');

Route::delete('/driver/posts/{id}','Driver\PostController@destroy');

Route::get('/users','UserController@index');

Route::get('/users/{id}','UserController@show');

Route::get('/users/{id}/edit','UserController@edit');

Route::put('/users/{id}','UserController@update');

Route::get('/search','SearchController@search');

Route::post('/search/distanceMatrix','SearchController@distanceMatrix');

Route::get('/search/driverlist','SearchController@driverlist');

Route::post('/search/driverlist/{id}','SearchController@show');