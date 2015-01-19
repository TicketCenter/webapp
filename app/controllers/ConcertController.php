<?php

class ConcertController extends BaseController {

	public function getConcerts()
	{	
		$view = View::make('concert/ConcertOverviewView');
		return $view;
	}
}
