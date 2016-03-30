<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect()->intended('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/login', 'AuthController@login');
	Route::get('/auth', 'AuthController@auth');
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
	Route::post('/join', ['as' => 'join', 'uses' => 'HomeController@join']);
	Route::get('/groups', ['as' => 'groups', 'uses' => 'GroupsController@index']);
	Route::post('/create_group', ['as' => 'create_group', 'uses' => 'GroupsController@create']);
	Route::post('/kick', ['as' => 'kick', 'uses' => 'GroupsController@kick']);
	Route::post('/delete_group', ['as' => 'delete_group', 'uses' => 'GroupsController@delete']);
});
