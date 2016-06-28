$(function(){
	
	var find = '';
	var page = 1;
	var page = $('#nav').val();
	var base = $('#base').val();

	$('.dropdown-toggle').dropdown();

	$('#find').keyup(function(){
		find = $(this).val();
		$('#nav').val(1);
		user(base, 1, find);
	});

	$('#nav').keyup(function(){
		page = $(this).val();
		user(base, page, find);
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

	setInterval(function(){
		page = $('#page').val();
		id_ = $('#id_').val();
		if($('.select2-offscreen').length == 0){
			$(".select").select2({
			    placeholder: ""
			});
		}
	},500);

	user(base, page, find);

});


function user(base, nav, find){
	$.ajax({
	    type : 'GET',
	    dataType : 'json',
	    url : base+'user/user/'+nav+'/'+find,
	    success : function(user){
			var tag = '';
			$("#page").val(user.id);
			for(i in user){
				var type = '';
				if(user[i].id){
					if (user[i].status == 1) {
						type = 'Admin';
					} else if(user[i].status == 2){
						type = 'Pimpinan';
					} else if(user[i].status == 3){
						type = 'Pegawai';
					} else {
						type = 'Tidak Aktiv';
					};
					tag += '<tr><td style="text-align:center;">'+user[i].nama+'</td><td>'+user[i].username+'</td><td style="text-align:center;">'+type+'</td><td style="text-align:center;"><a href="'+base+'user/form/'+user[i].id+'"><img src="'+base+'public/images/ubah.png" title="Ubah Data"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+base+'user/delete/'+user[i].id+'" onclick="return confirm('+"'Apakah Anda yakin akan menghapus data ini?'"+');"><img src="'+base+'public/images/hapus.png" title="Hapus Data"></a></td><tr>'; 
				}
			};
			$("#user").html(tag);
		}
	});
}