<?php
use App\Helpers\ClientHelper as Client;

class ArtistController extends BaseController
{
	/**
	 * Gets all the artists
	 * @return View ArtistOverviewView
	 */
	public function getArtists() {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30');
		$view = View::make('artist/ArtistOverviewView');
		$view->artists = $artists['artists']['artist'];
		return $view;
	}
	
	/**
	 * Gets a page of all the artists
	 * @param  Int $page Page number
	 * @return JSON       response
	 */
	public function getArtistsPage($page) {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&page_number=' . $page);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $artists['artists']['artist']
		));
	}

	/**
	 * Search artists per page
	 * @param  String $name Artist name
	 * @param  Int $page Page number
	 * @return JSON       response
	 */
	public function searchArtistsPage($name, $page) {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&characters=' . $name . '&page_number=' . $page);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $artists['artists']['artist']
		));
	}
	
	/**
	 * Search a specific artist by name
	 * @param  String $name Arist name
	 * @return View       ArtistOverviewView
	 */
	public function searchArtists($name) {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&characters=' . $name);
		$view = View::make('artist/ArtistOverviewView');
		$view->search = $name;
		if ($artists['status'] == 200) {
			$view->artists = $artists['artists']['artist'];
		}
		return $view;
	}
	
	/**
	 * Gets a specific artist by name
	 * @param  String $name Artist name
	 * @return View       ArtistView
	 */
	public function getArtist($name) {
		$artist = Client::getData('/artists/' . $name . '?api_key=' . Config::get('app.api_key'));
		$view = View::make('artist/ArtistView');
		$view->artist = $artist['artist'];
		return $view;
	}

	/**
	 * Gets 5 first artists
	 * @return JSON response
	 */
	public function getInterestingArtists() {
		$artists = Client::getData('/artists?api_key=' . Config::get('app.api_key') . '&page_size=5');
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $artists['artists']['artist']
		));
	}
}
