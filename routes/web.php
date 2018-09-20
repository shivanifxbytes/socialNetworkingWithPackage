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
Route::get('friendSuggestionList', ['as'=>'pendingrequests','uses'=>'UserController@friendSuggestionList']);
Route::get('friendsList', ['as'=>'friendsList','uses'=>'UserController@friendsList']);
Route::get('add/{id}', ['as'=>'add','uses'=>'UserController@addFriend']);
Route::get('accept/{id}', ['as'=>'accept','uses'=>'UserController@acceptFriend']);

Route::get('viewposts', 'PostController@viewUserPosts');
Route::get('addPost', 'PostController@addNewPost');
Route::post('addPost', 'PostController@submitPost');
Route::post('like', 'PostController@getLikes');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
