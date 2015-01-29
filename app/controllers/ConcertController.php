<?php
use App\Helpers\ClientHelper as Client;
use Carbon\Carbon;
class ConcertController extends BaseController
{
	/**
	 * Gets all the concert with a limit of 30.
	 * @return View ConcertOverView
	 */
	public function getConcerts() {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30');
		$concerts = $this->reformatDateTime($concerts['concerts']);
		$view = View::make('concert/ConcertOverviewView');
		$view->concerts = $concerts['concert'];
		return $view;
	}
	
	/**
	 * Gets a specific concert according to an ID.
	 * @param  String $id ID of concert
	 * @return View     ConcertView
	 */
	public function getConcert($id) {
		$concert = Client::getData('/concerts/' . $id . '?api_key=' . Config::get('app.api_key'));
		$dt = Carbon::parse($concert['concert']['start_time']);
		$start_time = array(
			'date' => $dt->format('d-m-Y') ,
			'time' => $dt->format('H:i')
		);
		$concert['concert']['start_time'] = $start_time;
		$view = View::make('concert/ConcertView');
		$view->concert = $concert['concert'];
		return $view;
	}
	
	/**
	 * Gets page x of all the concerts with a limit of 30.
	 * @param  Int $page Page number
	 * @return JSON       response
	 */
	public function getConcertsPage($page) {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&page_number=' . $page);
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}
	
	/**
	 * Gets page x of the concerts that matches the search parameter.
	 * @param  String $location 
	 * @param  Int $page     Page number
	 * @return JSON           response
	 */
	public function searchConcertsPage($location, $page) {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&location=' . $location . '&page_number=' . $page);
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}
	
	/**
	 * Search concerts.
	 * @param  String $location 
	 * @return View           ConcertOverviewView
	 */
	public function searchConcerts($location) {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&location=' . $location);
		$view = View::make('concert/ConcertOverviewView');
		$view->search = $location;
		if ($concerts['status'] == 200) {
			$concerts = $this->reformatDateTime($concerts['concerts']);
			$view->concerts = $concerts['concert'];
		}
		return $view;
	}
	
	/**
	 * Gets first 5 random concerts.
	 * @return JSON response
	 */
	public function getInterestingConcerts() {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=5');
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}
	
	/**
	 * Gets concerts of a artist
	 * @param  String $artist name
	 * @return JSON         response
	 */
	public function getArtistConcerts($artist) {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=5' . '&artist=' . $artist);
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}
	
	/**
	 * Reformats the date time in the concert.
	 * @param  Array $data 
	 * @return Array       Data
	 */
	private function reformatDateTime($data) {
		foreach ($data['concert'] as $dataIndex => $value) {
			foreach ($data['concert'][$dataIndex] as $key => $value) {
				if ($key == 'start_time') {
					$datetime = $data['concert'][$dataIndex]['start_time'];
					$dt = Carbon::parse($datetime);
					$start_time = array(
						'date' => $dt->format('d-m-Y') ,
						'time' => $dt->format('H:i')
					);
					$data['concert'][$dataIndex]['start_time'] = $start_time;
				}
			}
		}
		return $data;
	}
}
