<?php
class Pendapatan_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}

	function pemasukan($id){
		return $this->db->one('pendapatan',"LEFT JOIN pemasukan ON pemasukan.id_pendapatan = pendapatan.id JOIN akun a ON debet = a.id JOIN akun b ON kredit = b.id WHERE pendapatan.id = '$id'",'pendapatan.*, a.belanja dbt, b.belanja krt');
	}

	function detail($id){
		return $this->db->read('pendapatan',"JOIN pemasukan ON pendapatan.id = pemasukan.id_pendapatan JOIN transaksi ON pemasukan.trans = transaksi.trans JOIN jurnal ON jurnal.trans = transaksi.trans JOIN akun a ON pendapatan.debet = a.id JOIN akun b ON pendapatan.kredit = b.id WHERE pemasukan.id = '$id'",'pendapatan.id id_pendapatan, pemasukan.id id_pemasukan, pendapatan.nama, pendapatan.debet, pendapatan.kredit, MONTH(transaksi.tanggal) bulan, YEAR(transaksi.tanggal) tahun, transaksi.tanggal, transaksi.id id_transaksi, jurnal.id id_jurnal, jurnal.debet debt,jurnal.kredit kret, a.belanja dbt, b.belanja krt');
	}
}