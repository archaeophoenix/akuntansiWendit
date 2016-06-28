<!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">
					Data Jurnal
					<label>
						<select id="tahun" class="select" style="height: 24px; width: 80px"></select>
						<select id="bulan" class="select" style="height: 24px; width: 120px"></select>
					</label>
				</div>
				<div class="display-tabel">Cari <input id="find" type="text"/> </div>
			</div>
      
      		<div class="content-tabel">
				<table class="tabel">
					<thead>
						<tr>
							<th width="24%">Keterangan</th>
							<th width="14%">Tanggal</th>
							<th width="14%">Nilai</th>
							<th width="14%">Debet</th>
							<th width="14%">Kredit</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody id="jurnal"></tbody>
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
				<input type="button" name="button" id="button" onclick="window.location='<?php echo X ?>jurnal/form'" value="Tambah Data" />
			</div>
		</div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->