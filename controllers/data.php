<?php
class Data extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::start();

		$this->getModel('login');
		if (!empty($_SESSION['id'])){
			$result = $this->login->login($_SESSION['username'], $_SESSION['password']);
		}
		
		if(!empty($result)){
			Session::start();
			$_SESSION = $result;
			Session::set('log',true);
		}

		if(Session::get('log') == false) {
			$this->direct(X.'login');
		}
	}

	function index(){
		$this->direct(X.'jurnal/data');
	}

	function tahun(){
		$data = $this->model->tahun();
		sort($data);
		echo json_encode($data,JSON_NUMERIC_CHECK);
	}

	function bulan(){
		$bulan = array(array('angka' => '01' , 'bulan' => 'Januari'), array('angka' => '02' , 'bulan' => 'Februari'), array('angka' => '03' , 'bulan' => 'Maret'), array('angka' => '04' , 'bulan' => 'April'), array('angka' => '05' , 'bulan' => 'Mei'), array('angka' => '06' , 'bulan' => 'Juni'), array('angka' => '07' , 'bulan' => 'Juli'), array('angka' => '08' , 'bulan' => 'Agustus'), array('angka' => '09' , 'bulan' => 'September'), array('angka' => '10' , 'bulan' => 'Oktober'), array('angka' => '11' , 'bulan' => 'November'), array('angka' => '12' , 'bulan' => 'Desember'));
		echo json_encode($bulan);
	}

}