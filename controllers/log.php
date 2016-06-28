<?php
class Log extends Controller{

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

		if(Session::get('log') == false || Session::get('status') != 2) {
			$this->direct(X.'login');
		}

		$this->getModel('data');
	}

	function index(){
		$list['sesi'] = 'Log Pegawai';

		$list['user'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['jurnal'] = '';
		$list['pendapatan'] = '';
		$list['log'] = 'class="active"';

		$list['load'] = null;
		$list['js'] = '<script src="'.X.'public/js/log.js"></script>';
		$this->view->render('log/list',$list);
	}

	function transaksi($year, $month, $nav, $find = null){
		$data = $this->data->jurnal($year, $month, $nav, $find);
		echo json_encode($data);
	}
}