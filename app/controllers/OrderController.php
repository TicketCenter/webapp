<?php
use App\Helpers\ClientHelper as Client;

class OrderController extends BaseController
{
	public function getOrderHistory() {

		$result = Client::getData('/orders/'. (int)Crypt::decrypt(Session::get('user_id')) .'/'. Crypt::decrypt(Session::get('token')), true);
		$view = View::make('order/OrderHistoryView');
		foreach ($result as $order => $value) {
			$result[$order]['ticket_path'] = 'http://hanze.nberlijn.nl/tickets/' . substr($value['ticket_path'], 35);
		}
		$view->result = $result;
		return $view;
	}
	
	public function orderTickets() {
		Session::put('ticket_price', Crypt::encrypt(Input::get('ticket_price')));
		Session::put('ticket_quantity', Crypt::encrypt(Input::get('ticket_quantity')));
		Session::put('ticket_concert_id', Crypt::encrypt(Input::get('ticket_concert_id')));
		Session::put('ticket_concert_title', Crypt::encrypt(Input::get('ticket_concert_title')));
		
		$ticket_total_price = (float)Input::get('ticket_price') * (float)Input::get('ticket_quantity');
		
		Session::put('ticket_total_price', Crypt::encrypt($ticket_total_price));
		
		return Response::json(array(
			'code' => '200',
			'message' => 'OK'
		));
	}
	
	public function getOrderView() {
		$view = View::make('order/OrderView');
		$view->ticket_price = Crypt::decrypt(Session::get('ticket_price'));
		$view->ticket_quantity = Crypt::decrypt(Session::get('ticket_quantity'));
		$view->ticket_concert_id = Crypt::decrypt(Session::get('ticket_concert_id'));
		$view->ticket_total_price = Crypt::decrypt(Session::get('ticket_total_price'));
		$view->ticket_concert_title = Crypt::decrypt(Session::get('ticket_concert_title'));
		return $view;
	}

	public function getOrderSuccesView() {
		$view = View::make('order/OrderSuccesView');
		$view->ticket_url = Session::get('ticket_url');
		return $view;
	}

	public function handlePayment() {
		if (Session::get('logged_in') == true) {
			$data = array(
				'concert_id' => Crypt::decrypt(Session::get('ticket_concert_id')) ,
				'price' => (float)Crypt::decrypt(Session::get('ticket_price')) ,
				'amount' => (float)Crypt::decrypt(Session::get('ticket_quantity')) ,
				'user_id' => (int)Crypt::decrypt(Session::get('user_id'))
			);
			$result = Client::postData('/orders/'.(int)Crypt::decrypt(Session::get('user_id')).'/'.Crypt::decrypt(Session::get('token')), json_encode($data));
		} else {
			
			$data = array(
				'concert_id' => Crypt::decrypt(Session::get('ticket_concert_id')) ,
				'price' => (float)Crypt::decrypt(Session::get('ticket_price')) ,
				'amount' => (float)Crypt::decrypt(Session::get('ticket_quantity')) ,
				'email_address' => Input::get('email_address') ,
				'name' => Input::get('name') ,
				'date_of_birth' => Input::get('date_of_birth')
			);
			$result = Client::postData('/orders', json_encode($data));
		}

		
		Session::put('ticket_url', 'http://hanze.nberlijn.nl/tickets/' . substr($result['ticket_path'], 35));

		return Response::json(array(
			'code' => '200',
			'message' => 'OK',
			'data' => json_encode($data)
		));
	}
}
