<!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Laporan <?php echo $laporan ?></div>
			</div>
      		<div class="content-tabel">
      			<div style="margin: 15px;">
      				
      				<select id="tahun" class="select" style="height: 24px; width: 70px"></select>
      				<select id="bulan" class="select" style="height: 24px; width: 100px"></select>
      				<?php if($lapor == 'perakun'){ ?>
      				<select id="akun" class="select" style="height: 24px; width: 250px"></select>
      				<?php } ?>
      				
      				<article style="margin:20px;width:1000px;height:600px;overflow-x:auto;overflow-y:auto;text-align:center"><div id="laporan"></div></article>
      			</div>
			</div>
  			<div class="navigasi-button">
  				<input type="hidden" id="file">
  				<input type="hidden" id="parameter" value="<?php echo $lapor ?>">
				<input type="submit" name="button" id="excel" value="Excel" />
				<input type="button" name="button" id="print" value="Print" />
			</div>
		</div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->