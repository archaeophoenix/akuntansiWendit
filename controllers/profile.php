<?php
class Profile extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();

		$this->getModel('login');
		if (!empty($_SESSION['id'])){
			$result = $this->login->login($_SESSION['id']);
		}
		
		if(!empty($result)){
			Session::start();
			$_SESSION = $result;
			Session::set('log',true);
		}

		if(Session::get('log') == false || Session::get('status') == 1) {
			$this->direct(X.'login');
		}

		$this->getModel('data');
	}

	function index(){
		$list['user'] = 'class="active"';
		$list['jurnal'] = '';
		$list['akun'] = '';
		$list['pendapatan'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		
		$list['data'] = $this->data->detail('user',$_SESSION['id']) ;

		$list['js']  = '<script type="text/javascript" src="'.X.'public/js/user.js"></script>';

		$this->view->render('user/form',$list);
	}

}