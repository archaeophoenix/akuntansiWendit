<?php
class Jurnal extends Controller{
	
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
		$this->direct(X.'jurnal/data');
	}

	function data(){
		$list['sesi'] = 'Jurnal';

		$list['user'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		$list['jurnal'] = 'class="active"';
		$list['pendapatan'] = '';

		$list['load'] = null;
		$list['js'] = '<script src="'.X.'public/js/jurnal.js"></script>';
		$this->view->render('jurnal/list',$list);
	}

	function form($id = null){
		$list['sesi'] = 'Jurnal';

		$list['user'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		$list['jurnal'] = 'class="active"';
		$list['pendapatan'] = '';

		$list['data'] = null;
		$data = (is_null($id)) ? null : $this->model->detail($id) ;

		if (!empty($data)) {
			foreach ($data as $value) {

				$list['data']['id'] = $id;
				$list['data']['tanggal'] = $value['tanggal'];
				$list['data']['keterangan'] = $value['keterangan'];

				if(empty($value['kredit'])){
					$list['data']['debet'] = $value['id_akun'] ;
					$list['data']['nilai'] = $value['debet'];
					$list['data']['id_debet'] = $value['id_jurnal'];
				}

				if (empty($value['debet'])){
					$list['data']['kredit'] =  $value['id_akun'] ;
					$list['data']['id_kredit'] = $value['id_jurnal'];
				}
			}
		}

		$list['js'] = '<script src="'.X.'public/js/jurnal.js"></script>';
		$this->view->render('jurnal/form',$list);
	}

	function upcreate($id = null){
		extract($_REQUEST);

		$transaksi['id'] = $id;
		$transaksi['id_user'] = $_SESSION['id'];
		$transaksi['keterangan'] = ucwords(strtolower($keterangan));

		$aktiva['id'] = $id_debet;
		$aktiva['debet'] = $nilai;
		$aktiva['kredit'] = 0;
		$aktiva['id_akun'] = $debet;

		$pasiva['id'] = $id_kredit;
		$pasiva['kredit'] = $nilai;
		$pasiva['debet'] = 0;
		$pasiva['id_akun'] = $kredit;

		if (empty($id)) {
			$trans = uniqid();
			
			$aktiva['trans'] = $trans;
			$pasiva['trans'] = $trans;
			$transaksi['trans'] = $trans;
			$transaksi['tanggal'] = date('Y-m-d');
			
			$this->data->create('transaksi',$transaksi);
			$this->data->create('jurnal',$aktiva);
			$this->data->create('jurnal',$pasiva);

		} else {
			$this->data->update('transaksi',$transaksi);
			$this->data->update('jurnal',$aktiva);
			$this->data->update('jurnal',$pasiva);
		}

		$this->direct(X.'jurnal/data');
	}

	function transaksi($year, $month, $nav, $find = null){
		$data = $this->data->jurnal($year, $month, $nav, $find);
		echo json_encode($data);
	}

	function akun(){
		$akun = $this->data->id_('akun');
		echo json_encode($akun);
	}
}