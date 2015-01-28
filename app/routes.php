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

// User
Route::get('/login', array('as' => 'login', 'uses' => 'UserController@getLoginView'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
Route::post('/handleLogin', array('as' => 'handleLogin', 'uses' => 'UserController@handleLogin'));
Route::get('/register', array('as' => 'register', 'uses' => 'UserController@getRegistrationView'));
Route::post('/handleRegistration', array('as' => 'handleRegistration', 'uses' => 'UserController@handleRegistration'));
Route::get('/register/complete', array('as' => 'registrationComplete', 'uses' => 'UserController@getRegistrationCompleteView'));

// Concert
Route::get('/concerts', array('as' => 'concerts', 'uses' => 'ConcertController@getConcerts'));
Route::get('/concert/{id}', 'ConcertController@getConcert');
Route::get('/concerts/search/{location}','ConcertController@searchConcerts');
Route::get('/concerts/search/{location}/page/{page}', 'ConcertController@searchConcertsPage');
Route::get('/concerts/page/{page}', 'ConcertController@getConcertsPage');
Route::get('/concerts/interesting', 'ConcertController@getInterestingConcerts');

// Artist
Route::get('/artists', array('as' => 'artists', 'uses' => 'ArtistController@getArtists'));
Route::get('/artists/search/{name}','ArtistController@searchArtists');
Route::get('/artists/search/{name}/page/{page}', 'ArtistController@searchArtistsPage');
Route::get('/artists/page/{page}', 'ArtistController@getArtistsPage');
Route::get('/artist/{name}','ArtistController@getArtist');
Route::get('/artists/interesting', 'ArtistController@getInterestingArtists');

// Root
Route::get('/', 'HomeController@getIndex');

