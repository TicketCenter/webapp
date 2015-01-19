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
// Shared variable
View::share('baseurl', Config::get('app.baseurl'));
View::share('logged_in', Session::get('logged_in'));

// Login
Route::get('/login', array('as' => 'login', 'uses' => 'HomeController@getLoginView'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));
Route::post('/handleLogin', array('as' => 'handleLogin', 'uses' => 'LoginController@handleLogin'));

// Concert
Route::get('/concerts', array('as' => 'concerts', 'uses' => 'ConcertController@getConcerts'));

// Artist
Route::get('/artists', array('as' => 'artists', 'uses' => 'ArtistController@getArtists'));

// Test
Route::get('/test', 'LoginController@devGetSession');

// Root
Route::get('/', 'HomeController@getIndex');

