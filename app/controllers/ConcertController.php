<?php
use App\Helpers\ClientHelper as Client;
use Carbon\Carbon;
class ConcertController extends BaseController
{
	
	public function getConcerts() {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30');
		$concerts = $this->reformatDateTime($concerts['concerts']);
		$view = View::make('concert/ConcertOverviewView');
		$view->concerts = $concerts['concert'];
		return $view;
	}
	
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

	public function getConcertsPage($page) {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&page_number=' . $page);
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}

	public function searchConcertsPage($location, $page) {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=30' . '&location=' . $location . '&page_number=' . $page);
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}

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

	public function getInterestingConcerts() {
		$concerts = Client::getData('/concerts?api_key=' . Config::get('app.api_key') . '&page_size=5');
		$concerts = $this->reformatDateTime($concerts['concerts']);
		return Response::json(array(
			'status' => '200',
			'message' => 'OK',
			'data' => $concerts['concert']
		));
	}
	
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
