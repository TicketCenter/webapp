<?php

class ArtistController extends BaseController {
	public function getArtists()
	{	
		$view = View::make('artist/ArtistOverviewView');
		return $view;
	}
}
