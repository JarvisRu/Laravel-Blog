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

Route::get('/home', 'HomeController@index')->name('home');
// post
Route::get('/home/add', 'HomeController@goPost')->name('post');
Route::post('/home', 'HomeController@updatePost');
Route::get('/home/view_{id}', 'HomeController@viewPost')->name('view_{id}');
Route::delete('/home/delete_{id}', 'HomeController@destoryPost');
// comment
Route::post('/home/view_{id}', 'HomeController@updateComment');
Route::delete('/home/deleteC_{id}_{p_id}', 'HomeController@destoryComment');
