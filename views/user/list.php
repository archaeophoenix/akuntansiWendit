<!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Data User</div>
				<div class="display-tabel">Cari <input id="find" type="text"/> </div>
			</div>
      
      		<div class="content-tabel">
				<table class="tabel">
					<thead>
						<tr>
							<th width="25%">Nama</th>
							<th width="40%">Username</th>
							<th width="25%">Status</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody id="user"></tbody>
				</table>
			</div>
			<div class="header-bottom-tabel">
				<div class="title-bottom-tabel">
					<div class="nav-1" id="first"><div></div><div></div></div>
					<div class="nav-2" id="previous"><div></div></div>
					<div class="nav-3">Halaman ke <input name="nav" style="width:50px; text-align:center;" id="nav" type="text" value="1" /></div>
					<div class="nav-4" id="next"><div></div></div>
					<div class="nav-5" id="last"><div></div><div></div></div>
				</div>
			</div>
  			<div class="navigasi-button">
				<input type="button" name="button" id="button" onclick="window.location='<?php echo X ?>user/form'" value="Tambah Data" />
			</div>
		</div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->