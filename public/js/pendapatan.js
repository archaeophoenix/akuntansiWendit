function id_akun(akun,nuka){
	var id_ = $('#id_').val();
	$('#'+nuka).html(id_);
	var elect = $('#'+akun).val();
	$('input[name="'+akun+'"]').val(elect);
	$('#'+nuka+' option[value="'+elect+'"]').remove();
}

function nice(val) {
  return ( val < 10 ? "0" : "" ) + val;
}

function tanggal(){
  var now = new Date();
  var date = nice(now.getFullYear())+'-'+nice(now.getMonth()+1)+'-'+nice(now.getDate());
  return date;
}

function pendapatan(base, year, month, nav, find){
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'pendapatan/pendapatan/'+year+'/'+month+'/'+nav+'/'+find,
	    success : function(pendapatan){
			var tag = '';
			$("#page").val(pendapatan.id);
			for(i in pendapatan){
				if(pendapatan[i].pendapatan_id){
					var now = tanggal();
					var tgl = (pendapatan[i].tanggal) ? date(pendapatan[i].tanggal) : '' ;
					var status = (pendapatan[i].nilai == '0') ? 'Belum Bayar' : 'Sudah Bayar' ;
					var transaksi = (now == pendapatan[i].tanggal || pendapatan[i].tanggal == '') ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+base+'pendapatan/transaksi/'+pendapatan[i].pendapatan_id+'/'+pendapatan[i].pemasukkan_id+'"><img src="'+base+'public/images/87.png" width="16" height="16" title="Pembayaran"></a>' : '' ;

					tag += '<tr><td>'+pendapatan[i].nama+'</td><td style="text-align:center;">'+tgl+'</td><td align="right">'+number(pendapatan[i].nilai)+'</td><td align="center">'+status+'</td><td style="text-align:center;"><a href="'+base+'pendapatan/form/'+pendapatan[i].pendapatan_id+'"><img src="'+base+'public/images/ubah.png" title="Ubah Data"></a>'+transaksi+'<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#'+pendapatan[i].pendapatan_id+'"><img src="'+base+'public/images/hapus.png" title="Hapus Data"></a>--></td><tr>'; 
				}
			};
			$("#pendapatan").html(tag);
		}
	});
}

function month(index){
	var month = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
	return month[index];
}

function date(tanggal){
	var date = new Date(tanggal);
	var dates = (date.getDate() + " " + month(date.getMonth()) + " " + date.getFullYear());
	return dates;
}

function number(n) {
	r = (n < 0) ? n*-1 : n ;
	var ret = (Math.round(r * 100) / 100).toLocaleString() + '.00';
    ret = (n < 0) ? '('+ret+')' : ret ;
    return "Rp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + ret;
}

$(function(){

	var id_ = '';
	var find = '';
	var page = 1;
	var thn = $('#thn').val();
	var bln = $('#bln').val();
	var dbt = $('#dbt').val();
	var krt = $('#krt').val();
	var page = $('#nav').val();
	var base = $('#base').val();

	$('.dropdown-toggle').dropdown();

	$('.tanggal').datepicker({
        changeMonth: true,  
        changeYear: true ,
        dateFormat: 'yy-mm-dd'
    });

	$('#tahun').change(function(){
		thn = $(this).val();
		pendapatan(base, thn, bln, page, find);
	});

	$('#find').keyup(function(){
		find = $(this).val();
		$('#nav').val(1);
		pendapatan(base, thn, bln, 1, find);
	});

	$('#nav').keyup(function(){
		page = $(this).val();
		pendapatan(base, thn, bln, page, find);
	});

	$('#bulan').change(function(){
		bln = $(this).val();
		pendapatan(base, thn, bln, page, find);
	});

	$('#first').click(function(){
		var nav = parseInt($('#nav').val());
		if(nav > 1){
			$('#nav').val(1);
			$('#nav').keyup();
		}	
	});

	$('#previous').click(function(){
		var nav = parseInt($('#nav').val());
		if(nav>1){
			$('#nav').val(nav-1);
			$('#nav').keyup();	
		}
	});

	$('#next').click(function(){
		var nav = parseInt($('#nav').val());
		if(nav < page){
			$('#nav').val(nav+1);
			$('#nav').keyup();	
		}
	});
	
	$('#last').click(function(){
		var nav = parseInt($('#nav').val());
		if(nav < page){
			$('#nav').val(page);
			$('#nav').keyup();
		}
	});

	$('.number').keypress(function(e) {
	    var regex = new RegExp("^[0-9]+$");
	    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	    if (regex.test(str)) {
	        return true;
	    }
	    e.preventDefault();
	    return false;
	});

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
	    url : base+'pendapatan/akun',
	    success : function(akun){
			var select_akun = '<option></option>';
	    	var debt = $('input[name="debet"]').val();
	    	var krdt = $('input[name="kredit"]').val();
	    	for(i in akun){
	    		select_akun += '<option value="'+akun[i].id+'">'+akun[i].belanja+'</option>';
	    	};
	    	$("#id_").val(select_akun);
	    	$(".akun").html(select_akun);
	    	if(debt){
	    		$('#debet').val(debt);
	    		$('#kredit option[value="'+debt+'"]').remove();
	    	}
	    	if(krdt){
	    		$('#kredit').val(krdt);
	    		$('#debet option[value="'+krdt+'"]').remove();
	    	}
	    }
	});

	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'data/bulan',
	    success : function(bulan){
			var tag = '';
	    	for(i in bulan){
	    		tag += '<option value="'+bulan[i].angka+'">'+bulan[i].bulan+'</option>';
	    	};
	    	$("#bulan").html(tag);
	    	$("#bulan").val(bln);
	    }
	});
	
	pendapatan(base, thn, bln, page, find);

	setInterval(function(){
		page = $('#page').val();
		id_ = $('#id_').val();
		if($('.select2-offscreen').length == 0){
			$(".select").select2({
			    placeholder: ""
			});
		}
	},500);

});