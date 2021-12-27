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
Auth::routes();

Route::get('/', function () {
    return view('homepage');
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

Route::get('/carpooler/applications','Carpooler\ApplicationController@index');

Route::get('/carpooler/applications/{id}','Carpooler\ApplicationController@show');

Route::delete('/carpooler/applications/{id}','Carpooler\ApplicationController@destroy');

Route::post('/carpooler/applications/create','Carpooler\ApplicationController@store');

Route::get('/driver/applications','Driver\ApplicationController@index');

Route::get('/driver/applications/{id}','Driver\ApplicationController@show');

Route::get('/home', 'HomeController@index')->name('home');
