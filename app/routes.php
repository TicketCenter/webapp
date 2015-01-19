<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', array('as' => 'login', 'uses' => 'HomeController@getLoginView'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));
Route::post('/handleLogin', array('as' => 'handleLogin', 'uses' => 'LoginController@handleLogin'));

Route::get('/test', 'LoginController@devGetSession');

Route::get('/', 'HomeController@getIndex');

