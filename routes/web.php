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

Route::get('/driver/posts/{id}','Driver\PostController@show');

Route::get('/search/driverlist','SearchController@driverlist');

Route::get('/search/driverlist/{id}','SearchController@show');