<?php
class Laporan extends Controller{

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
		$this->direct(X.'laporan/lapor/jurnal');
	}

	function akun(){
		$akun = $this->data->id_('akun');
		echo json_encode($akun);
	}

	function report($jenis, $year, $month, $akun = null){
		$data = array();
		switch ($jenis) {
			case 'neraca':
				$data[0] = $this->model->debit($year, $month);
				$data[1] = $this->model->kredit($year, $month);
				$data[2] = $this->model->modal($year, $month);
			break;
			case 'labarugi':
				$data = $this->model->labarugi($year, $month);
			break;
			case 'jurnal':
				$data = $this->model->jurnal($year, $month);
			break;
			case 'perakun':
				$data = $this->model->perakun($year, $month, $akun);
			break;
		}
		/*echo "<pre>";
		print_r($data);*/

		echo json_encode($data);
	}

	function lapor($lapor){
		$list['sesi'] = 'Laporan';

		$list['user'] = '';
		$list['jurnal'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown active"';
		$list['log'] = '';
		$list['pendapatan'] = '';

		if($lapor == 'neraca' || $lapor == 'jurnal' || $lapor == 'labarugi' || $lapor == 'perakun' ){
			
			$list['lapor'] = $lapor;
			$list['laporan'] = ucwords($lapor);
			$list['js']  = '<script type="text/javascript" src="'.X.'public/js/print.js"></script>';
			$list['js'] .= '<script type="text/javascript" src="'.X.'public/js/laporan.js"></script>';
	 		$list['perakun'] = ($lapor == 'perakun') ? '<select id="akun" class="select" style="height: 24px; width: 250px"></select>' : null ;
	 		
			$this->view->render('laporan/laporan',$list);
		} else{
			$this->direct(X.'laporan/lapor/jurnal');
		}

	}
}