<?php
class Logout extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();
		if(Session::get('log') == false) {
			Session::destroy();
			$this->direct(X.'login');
		}
	}

	function index(){
		Session::destroy();
		$this->direct(X.'login');
	}
}