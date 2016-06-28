function akun(base, nav, find){
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'akun/akun/'+nav+'/'+find,
	    success : function(akun){
			var tag = '';
			$("#page").val(akun.id);
			for(i in akun){
				if(akun[i].id){
					tag += '<tr><td style="text-align:center;">'+akun[i].nama+'</td><td>'+akun[i].belanja+'</td><td style="text-align:center;">'+akun[i].jenis+'</td><td style="text-align:center;"><a href="'+base+'akun/form/'+akun[i].id+'"><img src="'+base+'public/images/ubah.png" title="Ubah Data"></a><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#'+akun[i].id+'"><img src="'+base+'public/images/hapus.png" title="Hapus Data"></a>--></td><tr>'; 
				}
			};
			$("#akun").html(tag);
		}
	});
}

$(function(){

	var find = '';
	var page = 1;
	var page = $('#nav').val();
	var base = $('#base').val();

	$('.dropdown-toggle').dropdown();

	$('#find').keyup(function(){
		find = $(this).val();
		$('#nav').val(1);
		akun(base, 1, find);
	});

	$('#nav').keyup(function(){
		page = $(this).val();
		akun(base, page, find);
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
	    url : base+'akun/jenis',
	    success : function(jenis){
			var tag = '';
			var jns = $("#jns").val();
	    	for(i in jenis){
	    		tag += '<option value="'+jenis[i].id+'">'+jenis[i].jenis+'</option>';
	    	};
	    	$("#jenis").html(tag);
	    	if(jns){
		    	$("#jenis").val(jns);
	    	}
	    }
	});

	akun(base, page, find);

	setInterval(function(){
		page = $('#page').val();
		if($('.select2-offscreen').length == 0){
			$(".select").select2({
			    placeholder: ""
			});
		}
	},500);
	
});