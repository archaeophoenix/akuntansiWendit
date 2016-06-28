$(function() {
	
	var val = '';
	var akn = '';
	var akun = 1;
	var thn = $('#thn').val();
	var bln = $('#bln').val();
	var base = $('#base').val();
	var parameter = $('#parameter').val();

	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'data/tahun',
	    success : function(tahun){
			var tag = '';
	    	for(i in tahun){
	    		tag += '<option value="'+tahun[i].tahun+'">'+tahun[i].tahun+'</option>';
	    	};
	    	$("#tahun").html(tag);
	    	$("#tahun").val(thn);
	    }
	});

	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'data/bulan',
	    success : function(bulan){
			var tag = '';
	    	for(i in bulan){
	    		tag += '<option rel="'+bulan[i].bulan+'" value="'+bulan[i].angka+'">'+bulan[i].bulan+'</option>';
	    	};
	    	$("#bulan").html(tag);
	    	$("#bulan").val(bln);
			val = $("#bulan option:selected").attr("rel");
			switch(parameter){
				case 'neraca':
					neraca(base, parameter, thn, bln, val);
				break;
				case 'labarugi':
					labarugi(base, parameter, thn, bln, val);
				break;
				case 'jurnal':
					jurnal(base, parameter, thn, bln, val);
				break;
	    		case 'perakun':
					perakun(base, parameter, akun, thn, bln, val, akn);
				break;
			}
	    }
	});

	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'laporan/akun',
	    success : function(akun){
			var tag = '<option></option>';
	    	for(i in akun){
	    		tag += '<option rel="'+akun[i].belanja+'" value="'+akun[i].id+'">'+akun[i].belanja+'</option>';
	    	};
	    	$("#akun").html(tag);
	    	$("#akun").val(1);
	    }
	});

	$('#bulan').change(function(){
		bln = $(this).val();
		val = $("#bulan option:selected").attr("rel");
		switch(parameter){
			case 'neraca':
				neraca(base, parameter, thn, bln, val);
			break;
			case 'labarugi':
				labarugi(base, parameter, thn, bln, val);
			break;
			case 'jurnal':
				jurnal(base, parameter, thn, bln, val);
			break;
			case 'perakun':
				perakun(base, parameter, akun, thn, bln, val, akn);
			break;
		}
	});

	$('#tahun').change(function(){
		thn = $(this).val();
		switch(parameter){
			case 'neraca':
				neraca(base, parameter, thn, bln, val);
			break;
			case 'labarugi':
				labarugi(base, parameter, thn, bln, val);
			break;
			case 'jurnal':
				jurnal(base, parameter, thn, bln, val);
			break;
			case 'perakun':
				perakun(base, parameter, akun, thn, bln, val, akn);
			break;
		}
	});

	$('#akun').change(function(){
		akun = $(this).val();
		akn = $("#akun option:selected").attr("rel");
		perakun(base, parameter, akun, thn, bln, val, akn);
	});

	setInterval(function(){
		if($('.select2-offscreen').length == 0){
			$(".select").select2({
			    placeholder: ""
			});
		}
	},500);

	$("#excel").click(function(e) {

        var a = document.createElement('a');
        var data_type = 'data:application/vnd.ms-excel';
        var table_div = $('#laporan')[0];
        var table_html = table_div.outerHTML.replace(/ /g, '%20');
        a.href = data_type + ', ' + table_html;
        a.download = $('#file').val() + '.xls';
        a.click();
        e.preventDefault();

    });

    $('#print').click(function(){
		$('#laporan').printArea();
		return false;
    });
	
});

function number(n) {
	r = (n < 0) ? n*-1 : n ;
	var ret = (Math.round(r * 100) / 100).toLocaleString() + '.00';
    return (n < 0) ? '('+ret+')' : ret ;
}

function jurnal(base, parameter, year, month, bulan){
	var total = 0;
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'laporan/report/'+parameter+'/'+year+'/'+month,
	    success : function(report){
			var tag = '<table align="center" width="75%"><thead style="text-align:center;"><tr><th colspan="6">JURNAL</th></tr><tr></tr><tr><th colspan="6">Taman Wisata Wendit</th></tr><tr></tr><tr><th colspan="6">BULAN '+bulan.toUpperCase()+' '+year+'</th></tr><tr><th>TANGGAL</th><th>KETERANGAN</th><th>DEBIT</th><th>KREDIT</th></tr></thead><tbody>';
	    	for(i in report){
	    		total += parseInt(report[i].nilai);
	    		tag += '<tr><td rowspan="3">'+report[i].hari+'</td><td colspan="3" align="left">'+report[i].keterangan.toUpperCase()+'</td></tr><tr><td align="left">'+report[i].debet+'</td><td align="right">'+number(report[i].nilai)+'</td><td align="right">'+number(0)+'</td></tr><tr><td align="left">'+report[i].kredit+'</td><td align="right">'+number(0)+'</td><td align="right">'+number(report[i].nilai)+'</td></tr><tr><td colspan="4">&nbsp;</td></tr>';
	    	};
	    	$("#laporan").html(tag+'<tr><th colspan="2" align="center">Total</th><th align="right">'+number(total)+'</th><th align="right">'+number(total)+'</th></tr></tbody></table>');
	    }
	});
	$('#file').val('jurnal_'+month+'_'+year);
}

function labarugi(base, parameter, year, month, bulan){
	var tdbt = 0;
	var tkrt = 0;
	var dbt = '';
	var krt = '';
	var total = 0;
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'laporan/report/'+parameter+'/'+year+'/'+month,
	    success : function(report){
	    	for(satu in report){
	    		for(dua in report[satu]){
	    			if(satu == 0){
	    				krt += '<tr><td width="10%" align="center">'+report[satu][dua].akun+'</td><td width="64%">'+report[satu][dua].belanja+'</td><td width="6%" align="left">Rp</td><td width="20%" align="right">'+number(report[satu][dua].nilai)+'</td></tr>';
	    				tkrt += parseInt(report[satu][dua].nilai);
	    			} else {
	    				dbt += '<tr><td width="10%" align="center">'+report[satu][dua].akun+'</td><td width="64%">'+report[satu][dua].belanja+'</td><td width="6%" align="left">Rp</td><td width="20%" align="right">'+number(report[satu][dua].nilai)+'</td></tr>';
	    				tdbt += parseInt(report[satu][dua].nilai);
	    			}
	    		}
	    	}
	    	total = tkrt - tdbt;
	    	var body = '<table align="center" width="50%"><thead style="text-align:center;"><tr><th colspan="3">LABA RUGI</th></tr><tr></tr><tr><th colspan="3">Taman Wisata Wendit</th></tr><tr></tr><tr><th colspan="3">BULAN '+bulan.toUpperCase()+' '+year+'</th></tr><tr></tr></thead><tbody><tr><td colspan="3" align="center"><table width="100%">'+krt+'</table></td></tr><tr><th width="74%" align="center">Jumlah Pendapatan</th><th width="6%" align="left">Rp</th><th width="20%" align="right">'+number(tkrt)+'</th></tr><tr><td colspan="3" align="center"><table width="100%">'+dbt+'</table></td></tr><tr><th width="74%" align="center">Jumlah Beban</th><th width="6%" align="left">Rp</th><th width="20%" align="right">'+number(tdbt)+'</th></tr><tr><th width="74%" align="center">Laba Bersih</th><th width="6%" align="left">Rp</th><th width="20%" align="right">'+number(total)+'</th></tr></tbody></table>';
	    	$('#laporan').html(body);
	    }
	});
	$('#file').val('labarugi_'+month+'_'+year);
}

function neraca(base, parameter, year, month, bulan){
	var tdbt = 0;
	var tkrt = 0;
	var krt = '';
	var dbt = '';
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'laporan/report/'+parameter+'/'+year+'/'+month,
	    success : function(data){
	    	for(satu in data){
	    		for(dua in data[satu]){
	    			if(satu == 0){
	    				dbt += '<tr><td width="10%" align="center">'+data[satu][dua].akun+'</td><td width="64%">'+data[satu][dua].belanja+'</td><td width="6%" align="left">Rp</td><td width="20%" align="right">'+number(data[satu][dua].nilai)+'</td></tr>';
	    				tdbt += parseInt(data[satu][dua].nilai);
	    			} else {
	    				krt += '<tr><td width="10%" align="center">'+data[satu][dua].akun+'</td><td width="64%">'+data[satu][dua].belanja+'</td><td width="6%" align="left">Rp</td><td width="20%" align="right">'+number(data[satu][dua].nilai)+'</td></tr>';
	    				tkrt += parseInt(data[satu][dua].nilai);
	    			}
	    		}
	    	}
			var body = '<table align="center" width="75%"><thead style="text-align:center;"><tr><th colspan="6">NERACA</th></tr><tr></tr><tr><th colspan="6">Taman Wisata Wendit</th></tr><tr></tr><tr><th colspan="6">BULAN '+bulan.toUpperCase()+' '+year+'</th></tr><tr></tr><tr><th colspan="3" width="50%">DEBIT</th><th colspan="3" width="50%">KREDIT</th></tr><tr></tr></thead><tbody><tr><td colspan="3" align="center"><table width="100%">'+dbt+'</table></td><td colspan="3" align="center"><table width="100%">'+krt+'</table></td></tr><tr><th align="center" width="37%">TOTAL</th><th align="left" width="3%">Rp</th><th align="right" width="10%">'+number(tdbt)+'</th><th align="center" width="37%">TOTAL</th><th align="left" width="3%">Rp</th><th align="right" width="10%">'+number(tkrt)+'</th></tr></tbody></table>';
			$("#laporan").html(body);
	    }
	});
	$('#file').val('neraca_'+month+'_'+year);
}

function perakun(base, parameter, akun, year, month, bulan, akn){
	var val = 0;
	var tag = '';
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'laporan/report/'+parameter+'/'+year+'/'+month+'/'+akun,
	    success : function(report){
    		val = report.sisa;
	    	for(i in report){
	    		if(i * 0 == 0){
		    		val += report[i].debet - report[i].kredit;
		    		tag += '<tr><td align="center">'+report[i].hari+'</td><td align="left">'+report[i].keterangan.toUpperCase()+'</td><td>Rp</td><td align="right">'+number(report[i].debet)+'</td><td>Rp</td><td align="right">'+number(report[i].kredit)+'</td><td>Rp</td><td align="right">'+number(val)+'</td></tr>';
	    		}
	    	}
	    	var body = '<table align="center" width="75%"><thead style="text-align:center;"><tr><th colspan="8">AKUN '+akn.toUpperCase()+'</th></tr><tr></tr><tr><th colspan="8">Taman Wisata Wendit</th></tr><tr></tr><tr><th colspan="8">BULAN '+bulan.toUpperCase()+' '+year+'</th></tr><tr></tr><tr><th width="10%">TANGGAL</th><th width="45%">KETERANGAN</th><th width="15%" colspan="2">DEBIT</th><th width="15%" colspan="2">KREDIT</th><th width="15%" colspan="2">SALDO</th></tr><tr><th colspan="6">SALDO BULAN LALU</th><th>Rp</th><th align="right">'+number(report.sisa)+'</th></tr></thead><tbody>'+tag+'<tr><th colspan="6">TOTAL</th><th>Rp</th><th align="right">'+number(val)+'</th></tr></tbody></table>';
	    	$("#laporan").html(body);
	    }
	});
	$('#file').val('akun_'+akn+'_'+month+'_'+year);
}