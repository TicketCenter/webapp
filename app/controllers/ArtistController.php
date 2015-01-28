<?php
use App\Helpers\ClientHelper as Client;

class ArtistController extends BaseController
{
	public function getArtists() {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30');
		$view = View::make('artist/ArtistOverviewView');
		$view->artists = $artists['artists']['artist'];
		return $view;
	}
	
	public function getArtistsPage($page) {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&page_number=' . $page);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $artists['artists']['artist']
		));
	}

	public function searchArtistsPage($name, $page) {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&characters=' . $name . '&page_number=' . $page);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $artists['artists']['artist']
		));
	}
	
	public function searchArtists($name) {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&characters=' . $name);
		$view = View::make('artist/ArtistOverviewView');
		$view->search = $name;
		if ($artists['status'] == 200) {
			$view->artists = $artists['artists']['artist'];
		}
		return $view;
	}
	
	public function getArtist($name) {
		$artist = Client::getData('/artists/' . $name . '?api_key=' . Config::get('app.api_key'));
		$view = View::make('artist/ArtistView');
		$view->artist = $artist['artist'];
		return $view;
	}

	public function getInterestingArtists() {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=5');
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $artists['artists']['artist']
		));
	}
}
