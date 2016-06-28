<?php

class Laporan_Model extends Model{

	function __construct(){
		parent::__construct();
	}

	function jurnal($year, $month){
		$kredit = $this->db->read('jurnal',"JOIN transaksi ON jurnal.trans=transaksi.trans JOIN akun ON jurnal.id_akun=akun.id WHERE MONTH(transaksi.tanggal) = '$month' AND YEAR(transaksi.tanggal) = '$year' AND debet = 0 ORDER BY transaksi.tanggal ASC",'jurnal.kredit nilai, akun.belanja kredit, transaksi.id id, transaksi.trans, DAY(transaksi.tanggal) hari, transaksi.keterangan');
		
		$debet = $this->db->read('jurnal',"JOIN transaksi ON jurnal.trans=transaksi.trans JOIN akun ON jurnal.id_akun=akun.id WHERE MONTH(transaksi.tanggal) = '$month' AND YEAR(transaksi.tanggal) = '$year' AND kredit = 0 ORDER BY transaksi.tanggal ASC",'jurnal.debet nilai, akun.belanja debet, transaksi.id id, transaksi.trans, DAY(transaksi.tanggal) hari, transaksi.keterangan');
		
		return array_replace_recursive($debet,$kredit);
	}

	function bulan($i){
		$bln = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return strtoupper($bln[$i-1]);
	}

	function hari($year, $month){
		return cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}

	function debit($year, $month){
		$day = $this->hari($year, $month);
		
		$debit = $this->db->read("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE id_jenis = '1' AND tanggal<='$year-$month-$day' GROUP BY akun.id","SUM( debet - kredit ) nilai, nama akun, belanja,id_jenis");

		return $debit;
	}

	function kredit($year, $month){
		$day = $this->hari($year, $month);
		
        $kredit = $this->db->read("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE id_jenis = '3' AND tanggal<='$year-$month-$day' GROUP BY akun.id","SUM( kredit - debet ) nilai, nama akun, belanja,id_jenis");

        return $kredit;
	}

	function modal($year, $month){
		$day = $this->hari($year, $month);

		$untung = $this->db->one("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE (id_jenis = '4' OR id_jenis= '5') AND tanggal<'$year-$month-01'","SUM( kredit - debet ) nilai");
        $labarugi = $this->db->one("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE (id_jenis = '4' OR id_jenis= '5') AND YEAR(tanggal)='$year' AND MONTH(tanggal)='$month'","SUM( kredit - debet ) nilai");
        $modal = $this->db->one("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE id_jenis = '2' AND tanggal<='$year-$month-$day'","SUM( kredit - debet ) nilai");

        $modals[0]['nilai'] = intval($untung['nilai'] + $modal['nilai']); 
        $modals[0]['belanja'] = 'MODAL';
        $modals[0]['akun'] = '';
        $modals[0]['id_jenis'] = '';
        $modals[1]['nilai'] = intval($labarugi['nilai']); 
        $modals[1]['belanja'] = 'Laba Rugi Bulan '.$this->bulan($month);
        $modals[1]['akun'] = '';
        $modals[1]['id_jenis'] = '';
        return $modals;
	}

	function labarugi($year, $month){
		$hasil = $this->db->read("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE id_jenis='4' AND YEAR(tanggal)='$year' AND MONTH(tanggal)='$month' GROUP BY akun.id","SUM( kredit - debet ) nilai, nama akun, belanja,id_jenis");
        $beban = $this->db->read("jurnal","JOIN akun ON akun.id = jurnal.id_akun JOIN transaksi ON transaksi.trans = jurnal.trans WHERE id_jenis='5' AND YEAR(tanggal)='$year' AND MONTH(tanggal)='$month' GROUP BY akun.id","SUM( debet - kredit ) nilai, nama akun, belanja,id_jenis");

        $data[0] = $hasil;
        $data[1] = $beban;

        return $data;
	}

	function perakun($year, $month, $akun){
		$sisa = $this->db->one("jurnal","JOIN transaksi ON jurnal.trans=transaksi.trans JOIN akun ON akun.id=jurnal.id_akun WHERE tanggal<'$year-$month-01' AND id_akun = $akun","SUM(debet-kredit) sisa");
        $datas = $this->db->read("jurnal","JOIN transaksi ON jurnal.trans=transaksi.trans JOIN akun ON akun.id=jurnal.id_akun WHERE YEAR(tanggal)='$year' AND MONTH(tanggal)='$month' AND id_akun = $akun ORDER BY tanggal,jurnal.id ASC","debet,kredit,DAY(tanggal) hari,keterangan,nama akun,belanja");
        $datas['sisa'] = $sisa['sisa'];
        $data = $datas;

        return $data;
	}
}