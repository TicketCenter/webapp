<?php

use Config;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{	
		JavaScript::put(
        [   
            'baseurl' => Config::get('app.baseurl')
        ]);

		$view = View::make('IndexView');
		return $view;
	}

	public function getLoginView()
	{
		$view = View::make('include/LoginView');
		return $view;
	}

}
