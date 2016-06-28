 <!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Input Form Jurnal</div>
			</div>
			<div class="content-form">
				<form method="post" action="<?php echo X.'jurnal/upcreate/'.$data['id'] ?>">
					<table width="574" border="0" align="center">
						<tr>
							<td width="181">Keterangan</td>
							<td width="373">
								<input type="text" name="keterangan" value="<?php echo $data['keterangan'] ?>" required="required" style="width:300px" />
							</td>
						</tr>
						<!--<tr><td>Tanggal</td><td><input type="text" name="tanggal" class="tanggal" value="<?php echo $data['tanggal'] ?>" required="required" /></td></tr>-->
						<tr>
							<td>Nilai</td>
							<td>
								<input type="text" name="nilai" class="number" value="<?php echo $data['nilai'] ?>" required="required" pattern="\d+" style="text-align:right" placeholder="X0000"/>
							</td>
						</tr>
						<tr>
							<td>Debet</td>
							<td>
								<select id="debet" re class="select akun" onchange="id_akun('debet','kredit')" style="width:250px"></select>
								<input type="hidden" name="id_debet" value="<?php echo $data['id_debet'] ?>">
								<input type="hidden" name="debet" value="<?php echo $data['debet'] ?>">
							</td>
						</tr>
						<tr>
							<td>Kredit</td>
							<td>
								<select id="kredit" class="select akun" onchange="id_akun('kredit','debet')" style="width:250px"></select>
								<input type="hidden" name="id_kredit" value="<?php echo $data['id_kredit'] ?>">
								<input type="hidden" name="kredit" value="<?php echo $data['kredit'] ?>">
							</td>
						</tr>
					</table>
					<div class="navigasi-button">
						<input type="submit" name="button" id="button" value="Submit" />
						<input type="button" name="button" id="button" onclick="window.location='<?php echo X ?>jurnal/data'" value="batal" />
						<input type="reset" name="reset" id="button" value="reset" />
					</div>
				</form>
			</div>
        </div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->