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

Auth::routes();

Route::get('/home', 'PostController@index')->name('home');
// post
Route::get('/home/add', 'PostController@goPost')->name('post');
Route::post('/home', 'PostController@updatePost');
Route::get('/home/view_{id}', 'PostController@viewPost')->name('view_{id}');
Route::delete('/home/delete_{id}', 'PostController@destoryPost');
// comment
Route::post('/home/view_{id}', 'CommentController@updateComment');
Route::delete('/home/deleteC_{id}_{p_id}', 'CommentController@destoryComment');
