<?php
class User extends Controller{
	
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

		if(Session::get('log') == false || Session::get('status') != 1) {
			$this->direct(X.'login');
		}

		$this->getModel('data');
	}

	function index(){
		$this->direct(X.'user/data');
	}

	function data(){
		$list['sesi'] = 'User';

		$list['user'] = 'class="active"';
		$list['jurnal'] = '';
		$list['pendapatan'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';

		$list['js']  = '<script type="text/javascript" src="'.X.'public/js/user.js"></script>';

		$this->view->render('user/list',$list);
	}

	function form($id = null){
		$list['sesi'] = 'User';
		$list['user'] = 'class="active"';
		$list['jurnal'] = '';
		$list['akun'] = '';
		$list['pendapatan'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		
		$list['data'] = (empty($id)) ? null : $this->data->detail('user',$id) ;

		$list['js']  = '<script type="text/javascript" src="'.X.'public/js/user.js"></script>';

		$this->view->render('user/form',$list);
	}

	function user($nav = 1, $find = null) {
		$data = $this->data->user($nav, $find);
		echo json_encode($data);
	}

	function upcreate($id = null){
		$_POST['nama'] = ucwords(strtolower($_POST['nama']));

		if (empty($id)) {
			$this->data->create('user');
		} else {

			if (empty($_POST['password'])){
				unset($_POST['password']);
			}

			$data = $_POST;

			$this->data->update('user',$data);
		}
		$this->direct(X.'user/data');
	}

	function delete($id){
		$this->data->delete('user',"id = '$id'");
		$this->direct(X.'user/data');
	}

}