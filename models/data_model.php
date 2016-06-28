<?php
class Data_Model extends Model{
	function __construct(){
		parent::__construct();
	}

	function jurnal($year, $month, $nav = 1, $find = null){
		$nav = (empty($nav) || $nav <= 1) ? 1 : $nav ;
		$nav = ($nav - 1) * 10 ;

		$find = (!empty($find)) ? $find=" AND (belanja LIKE '%$find%' OR tanggal LIKE '%$find%' OR keterangan LIKE '%$find%')" : null ;

		$count = $this->db->one('jurnal',"JOIN transaksi ON jurnal.trans=transaksi.trans JOIN akun ON jurnal.id_akun=akun.id WHERE MONTH(transaksi.tanggal) = '$month' AND YEAR(transaksi.tanggal) = '$year' $find","COUNT(transaksi.id) id");

		$kredit = $this->db->read('jurnal',"JOIN transaksi ON jurnal.trans=transaksi.trans JOIN akun ON jurnal.id_akun=akun.id JOIN user ON transaksi.id_user = user.id WHERE MONTH(transaksi.tanggal) = '$month' AND YEAR(transaksi.tanggal) = '$year' AND debet = 0 $find ORDER BY transaksi.tanggal, transaksi.id ASC LIMIT $nav , 10",'jurnal.kredit nilai, akun.belanja kredit,transaksi.id id,transaksi.trans,transaksi.tanggal,transaksi.keterangan,user.nama');
		
		$debet = $this->db->read('jurnal',"JOIN transaksi ON jurnal.trans = transaksi.trans JOIN akun ON jurnal.id_akun = akun.id JOIN user ON transaksi.id_user = user.id WHERE MONTH(transaksi.tanggal) = '$month' AND YEAR(transaksi.tanggal) = '$year' AND kredit = 0 $find ORDER BY transaksi.tanggal, transaksi.id ASC LIMIT $nav , 10",'jurnal.debet nilai, akun.belanja debet,transaksi.id id,transaksi.trans,transaksi.tanggal,transaksi.keterangan,user.nama');
		
		$jurn = array_replace_recursive($debet,$kredit);
		$min = (empty($find)) ? 20 : 10 ;
		$jurn['id'] = ceil($count['id']/$min);
		return $jurn;
	}

	function tahun(){
		return $this->db->read("transaksi","","DISTINCT(YEAR(tanggal)) tahun");
	}

	function id_($table ,$order = 'nama'){
		return $this->db->read($table,'ORDER BY '.$order.' ASC');
	}

	function akun($nav = 1, $find = null) {
		$nav = (empty($nav) || $nav <= 1) ? 1 : $nav ;
		$nav = ($nav - 1) * 10 ;

		if(!empty($find)){
			$find = "WHERE jenis LIKE '%$find%' OR nama LIKE '%$find%' OR belanja LIKE '%$find%'";
		}
        
        $data = $this->db->read("akun","JOIN jenis ON akun.id_jenis=jenis.id $find ORDER BY akun.nama,akun.id ASC LIMIT $nav , 10","jenis,nama,belanja,akun.id");
		$count = $this->db->one('akun',"JOIN jenis ON akun.id_jenis=jenis.id $find",'COUNT(akun.id) id');
		$data['id'] = ceil($count['id']/10);
		return $data;
	}

	function pendapatan($year, $month, $nav = 1, $find = null){
		$nav = (empty($nav) || $nav <= 1) ? 1 : $nav ;
		$nav = ($nav - 1) * 10 ;
		$finds = '';

		if(!empty($find)){
			$find = "WHERE nama LIKE '%$find%'";
		}

		$constan = array('nama' => '','debet' => '','kredit' => '','pendapatan_id' => '','pemasukkan_id' => '','nilai' => '0','tanggal' => '','id_user' => '');

		$data = $this->db->read('pendapatan',"$find ORDER BY nama ASC LIMIT $nav , 10",'nama, debet, kredit, id pendapatan_id');
		foreach ($data as $key => $val) {
			
			$data[$key] = array_replace_recursive($constan,$data[$key]);

			$masuk = $this->db->one('pemasukan',"JOIN jurnal ON pemasukan.trans = jurnal.trans JOIN transaksi ON pemasukan.trans = transaksi.trans WHERE kredit = 0 AND id_pendapatan = '$val[pendapatan_id]' AND YEAR(pemasukan.tanggal) = '$year' AND MONTH(pemasukan.tanggal) = '$month' ",'pemasukan.id pemasukkan_id, debet nilai, transaksi.tanggal, transaksi.id_user');
			
			if(!empty($masuk)){
				$data[$key] = array_replace_recursive($data[$key],$masuk);
			}
		}
        $count = $this->db->one('pendapatan',"$find",'COUNT(pendapatan.id) id');
		$data['id'] = ceil($count['id']/10);
		return $data;
	}

	function dapat($year, $month){
		$p = $this->db->read('pendapatan');
		$t = $this->db->read('trans',"WHERE MONTH(tanggal)='$month' AND YEAR(tanggal)='$year'");
		return array_replace_recursive($p,$t);
	}

	function user($nav = 1, $find = null) {
		$nav = (empty($nav) || $nav <= 1) ? 1 : $nav ;
		$nav = ($nav - 1) * 10 ;

		if(!empty($find)){
			$find = "WHERE username LIKE '$find' OR nama LIKE '$find'";
		}
        
        $data = $this->db->read("user","$find ORDER BY id ASC LIMIT $nav , 10","id,nama,status,username");
		$count = $this->db->one('user',"$find",'COUNT(user.id) id');
		$data['id'] = ceil($count['id']/10);
		return $data;
	}

	function read($table,$conditon = '',$data = '*'){
		return $this->db->read($table,$conditon,$data);
	}

	function create($table,$data = null){
		$this->db->create($table,$data);
	}

	function update($table,$data = null){
		$this->db->update($table,'id=:id',$data);
	}

	function delete($table,$id){
		$this->db->delete($table,$id);
	}

	function detail($table, $id){
		return $this->db->one($table,"WHERE id = '$id'");
	}

	function one($table,$conditon = '',$data = '*'){
		return $this->db->one($table,$conditon,$data);
	}
}