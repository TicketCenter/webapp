<?php

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

	public function showWelcome()
	{	
		JavaScript::put(
                [   
                    'translations' => [
                        'derp' => 'hoi'
                    ]
                ]);


		$view = View::make('hello');
		$view->message = 'why you no work';
		$view->please = "work";
		return $view;
	}

}
