<?php
class Jurnal_Model extends Model{
	function __construct(){
		parent::__construct();
	}

	function detail($id){
		return $this->db->read('transaksi',"JOIN jurnal ON transaksi.trans = jurnal.trans WHERE transaksi.id = '$id'",'transaksi.id id, tanggal, keterangan, jurnal.id id_jurnal, id_akun, debet, kredit');
	}

}