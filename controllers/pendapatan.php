<?php
class Pendapatan extends Controller{
	
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
		$this->direct(X.'pendapatan/data');
	}

	function pendapatan($year, $month, $nav = null, $find = null){
		$data = $this->data->pendapatan($year, $month, $nav, $find);
		echo json_encode($data);
	}

	function form($id = null){
		$list['sesi'] = 'Pendapatan';
		
		$list['user'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		$list['jurnal'] = '';
		$list['pendapatan'] = 'class="active"';

		$list['data'] = (is_null($id)) ? null : $this->data->detail('pendapatan',$id) ;

		$list['js'] = '<script src="'.X.'public/js/pendapatan.js"></script>';

		$this->view->render('pendapatan/form',$list);
	}

	function data(){
		$list['sesi'] = 'Pendapatan';

		$list['user'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		$list['jurnal'] = '';
		$list['pendapatan'] = 'class="active"';

		$list['js'] = '<script src="'.X.'public/js/pendapatan.js"></script>';
		$this->view->render('pendapatan/list',$list);
	}

	function transaksi($id, $pemasukan = null){
		$thn = date('Y');

		$list['val'] = null;
		$list['tahun'] = array();

		$list['bln'] = date('m');
		$list['thn'] = date('Y');
		
		$list['sesi'] = 'Jurnal';

		$list['user'] = '';
		$list['akun'] = '';
		$list['report'] = 'class="dropdown"';
		$list['log'] = '';
		$list['jurnal'] = '';
		$list['pendapatan'] = 'class="active"';

		$list['data'] = $this->model->pemasukan($id);
		$data = (is_null($pemasukan)) ? null : $this->model->detail($pemasukan);

		for ($i=$thn+5; $i > $thn; $i--) { 
			$list['tahun'][] = $i;
		}
		for ($i=$thn; $i >= $thn-5; $i--) { 
			$list['tahun'][] = $i;
		}

		if (!empty($data)) {
			foreach ($data as $value) {

				$list['bln'] = $value['bulan'];
				$list['thn'] = $value['tahun'];
				$list['val']['id_transaksi'] = $value['id_transaksi'];
				$list['val']['id_pemasukan'] = $value['id_pemasukan'];
				
				if(empty($value['kret'])){
					$list['val']['id_debet'] = $value['id_jurnal'];
					$list['val']['nilai'] = $value['debt'];
				}
				
				if (empty($value['debt'])){
					$list['val']['id_kredit'] = $value['id_jurnal'];
				}
			}
		}

		$list['bulan'] = array(array('angka' => '01' , 'bulan' => 'Januari'), array('angka' => '02' , 'bulan' => 'Februari'), array('angka' => '03' , 'bulan' => 'Maret'), array('angka' => '04' , 'bulan' => 'April'), array('angka' => '05' , 'bulan' => 'Mei'), array('angka' => '06' , 'bulan' => 'Juni'), array('angka' => '07' , 'bulan' => 'Juli'), array('angka' => '08' , 'bulan' => 'Agustus'), array('angka' => '09' , 'bulan' => 'September'), array('angka' => '10' , 'bulan' => 'Oktober'), array('angka' => '11' , 'bulan' => 'November'), array('angka' => '12' , 'bulan' => 'Desember'));

		$list['js'] = '<script src="'.X.'public/js/pendapatan.js"></script>';
		$this->view->render('pendapatan/transaksi',$list);
	}

	function hari($year, $month){
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}

	function jurnal($id = null){
		
		extract($_POST);
		$hari = date('d');
		if (strtotime(date('Y-m')) > strtotime(date($tahun.'-'.$bulan))) {
			$hari = $this->hari($tahun,$bulan);
		} elseif (strtotime(date('Y-m')) < strtotime(date($tahun.'-'.$bulan))) {
			$hari = '01';
		}

		$aktiva['id'] = $id_debet;
		$aktiva['debet'] = $nilai;
		$aktiva['kredit'] = 0;
		$aktiva['id_akun'] = $debet;

		$pasiva['id'] = $id_kredit;
		$pasiva['kredit'] = $nilai;
		$pasiva['debet'] = 0;
		$pasiva['id_akun'] = $kredit;

		$pemasukan['id'] = $id;
		$pemasukan['id_user'] = $_SESSION['id'];
		$pemasukan['id_pendapatan'] = $id_pendapatan;
		$pemasukan['tanggal'] = $tahun.'-'.$bulan.'-'.$hari;

		$transaksi['id'] = $id_transaksi;
		$transaksi['id_user'] = $_SESSION['id'];
		$transaksi['keterangan'] = 'Pendapatan dari '.$keterangan;

		if(empty($id)){
			$trans = uniqid();

			$aktiva['trans'] = $trans;
			$pasiva['trans'] = $trans;
			$pemasukan['trans'] = $trans;
			$transaksi['trans'] = $trans;
			
			$transaksi['tanggal'] = date('Y-m-d');

			$this->data->create('jurnal',$aktiva);
			$this->data->create('jurnal',$pasiva);
			$this->data->create('transaksi',$transaksi);
			$this->data->create('pemasukan',$pemasukan);
		} else {
			$this->data->update('jurnal',$aktiva);
			$this->data->update('jurnal',$pasiva);
			$this->data->update('transaksi',$transaksi);
			$this->data->update('pemasukan',$pemasukan);
		}

		$this->direct(X.'pendapatan/data');

	}

	function upcreate($id = null){

		$_POST['nama'] = ucwords(strtolower($_POST['nama']));
		
		if (empty($id)) {
			$this->data->create('pendapatan');
		} else {
			$this->data->update('pendapatan');
		}

		$this->direct(X.'pendapatan/data');
	}

	function akun(){
		$akun = $this->data->id_('akun');
		echo json_encode($akun);
	}
}