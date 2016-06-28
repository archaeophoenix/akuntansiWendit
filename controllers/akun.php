<?php
class Akun extends Controller{
	
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

		if(Session::get('log') == false || Session::get('status') != 3) {
			$this->direct(X.'login');
		}

		$this->getModel('data');
	}
	
	function index(){
		$this->direct(X.'/akun/data');
	}

	function form($id = null){
		$list['sesi'] = 'Akun';

		$list['user'] = '';
		$list['jurnal'] = '';
		$list['report'] = 'class="dropdown"';
		$list['akun'] = 'class="active"';
		$list['log'] = '';
		$list['pendapatan'] = '';

		$list['js'] = '<script src="'.X.'public/js/akun.js"></script>';
		$list['data'] = (empty($id)) ? null : $this->data->detail('akun',$id) ;
		$this->view->render('akun/form',$list);
	}

	function data(){
		$list['sesi'] = 'Akun';

		$list['user'] = '';
		$list['jurnal'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		$list['akun'] = 'class="dropdown active"';
		$list['pendapatan'] = '';

		$list['js'] = '<script src="'.X.'public/js/akun.js"></script>';
		$this->view->render('akun/list',$list);
	}

	function upcreate($id = null){
		$_POST['belanja'] = strtoupper($_POST['belanja']);
		if (empty($id)) {
			$this->data->create('akun');
		} else {
			$this->data->update('akun');
		}
		$this->direct(X.'akun/data');
	}

	function akun($nav = 1, $find = null) {
		$data = $this->data->akun($nav, $find);
		echo json_encode($data);
	}

	function jenis(){
		$data = $this->data->id_('jenis','jenis');
		echo json_encode($data);
	}
}