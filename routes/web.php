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
Route::get('/home/view/{post}', 'PostController@viewPost')->name('view/{post}');
Route::delete('/home/delete/{post}', 'PostController@destoryPost');
// comment
Route::post('/home/view/{post}', 'CommentController@updateComment');
Route::delete('/home/deleteC/{post}/{comment}', 'CommentController@destoryComment');
