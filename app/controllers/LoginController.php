<?php
use Input;
use Crypt;
use Session;
use Response;
class LoginController extends BaseController {
	
	/**
	* Handles login
	* @return JSON response
	*/
	
	public function handleLogin(){
			$username = Input::get('email');
			$password = Input::get('password');
			Session::put('u', Crypt::encrypt($username));
			Session::put('p', Crypt::encrypt($password));
			Session::put('logged_in', true);

			return Response::json(array('status' => '200', 'devmessage' => 'logged in.'));
	}
	
	/**
	* Logout user by clearing session.
	* @return JSON response
	*/
	
	public function logout(){
		Session::flush();
		return Redirect::to('/');
	}
	/**
	* Debug
	* @return debug data
	*/
	
	public function devGetSession(){
		$result = array('username' => Session::get('u'), 'password' => Session::get('p'));
		return Response::json(array('status' => '200', 'devmessage' => 'Here goes nothing', 'result' => $result));
	}
}