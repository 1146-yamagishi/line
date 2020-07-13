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

Route::group(['prefix' => 'admin'], function() {
    Route::get('line/create', 'Admin\LineController@add')->middleware('auth');
    Route::post('line/create', 'Admin\LineController@create')->middleware('auth');
    Route::get('line/index', 'Admin\LineController@index')->middleware('auth');
    Route::get('line/ranking', 'Admin\LineController@ranking')->middleware('auth');
    Route::get('/post/evaluation/{id}', 'Admin\PostsController@evaluation')->name('post.evaluation');
    Route::get('/post/unevaluation/{id}', 'Admin\PostsController@unevaluation')->name('post.unevaluation');
});
Auth::routes();

//  Route::get('/post/evaluation/{id}', 'Admin\PostsController@like')->name('post.evaluation');
//  Route::get('/post/unevaluation/{id}', 'Admin\PostsController@unlike')->name('post.unevaluation');

Route::get('/home', 'HomeController@index')->name('home');
