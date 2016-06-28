<?php
class Login extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();
		$url = '';
		if(Session::get('log') == true && Session::get('status') != 0) {
			switch ($_SESSION['status']) {
				case 3:
					$url = 'jurnal/data';
				break;
				case 2:
					$url = 'laporan/lapor/jurnal';
				break;
				case 1:
					$url = 'user/data';
				break;
			}
			$this->direct(X.$url);
		}
	}

	function index(){
		$this->view->single('login');
	}

	function logon(){
		$result = $this->model->logon();
		if(!empty($result)){
			Session::start();
			$_SESSION = $result;
			Session::set('log',true);
		}
		$this->direct(X.'login');
	}
	
}