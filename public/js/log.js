function jurnal(base, year, month, nav, find){
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'log/transaksi/'+year+'/'+month+'/'+nav+'/'+find,
	    success : function(jurnal){
			var nbr = 0 ;
			var tag = '';
			$("#page").val(jurnal.id);
			for(i in jurnal){
				if(jurnal[i].id){
					var tgl = date(jurnal[i].tanggal);

					tag += '<tr><td>'+jurnal[i].keterangan+'</td><td style="text-align:center;">'+tgl+'</td><td align="right">'+number(jurnal[i].nilai)+'</td><td align="right">'+jurnal[i].debet+'</td><td align="right">'+jurnal[i].kredit+'</td><td style="text-align:center;">'+jurnal[i].nama+'</td><tr>';
				}
			};
			$("#jurnal").html(tag);
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

	$('#tahun').change(function(){
		thn = $(this).val();
		jurnal(base, thn, bln, page, find);
	});

	$('#find').keyup(function(){
		find = $(this).val();
		$('#nav').val(1);
		jurnal(base, thn, bln, 1, find);
	});

	$('#nav').keyup(function(){
		page = $(this).val();
		jurnal(base, thn, bln, page, find);
	});

	$('#bulan').change(function(){
		bln = $(this).val();
		jurnal(base, thn, bln, page, find);
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
	    		tag += '<option value="'+bulan[i].angka+'">'+bulan[i].bulan+'</option>';
	    	};
	    	$("#bulan").html(tag);
	    	$("#bulan").val(bln);
	    }
	});
	
	jurnal(base, thn, bln, page, find);

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