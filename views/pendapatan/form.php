 <!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Input Form Pendapatan</div>
			</div>
			<div class="content-form">
				<form method="post" action="<?php echo X.'pendapatan/upcreate/'.$data['id'] ?>">
					<table width="574" border="0" align="center">
						<tr>
							<td width="181">Keterangan</td>
							<td width="373">
								<input type="hidden" name="id" value="<?php echo $data['id'] ?>"/>
								<input type="text" name="nama" value="<?php echo $data['nama'] ?>" required="required" style="width:300px" />
							</td>
						</tr>
						<tr>
							<td>Debet</td>
							<td>
								<select id="debet" class="select akun" onchange="id_akun('debet','kredit')" style="width:310px"></select>
								<input type="hidden" name="debet" value="<?php echo $data['debet'] ?>">
							</td>
						</tr>
						<tr>
							<td>Kredit</td>
							<td>
								<select id="kredit" class="select akun" onchange="id_akun('kredit','debet')" style="width:310px"></select>
								<input type="hidden" name="kredit" value="<?php echo $data['kredit'] ?>">
							</td>
						</tr>
					</table>
					<div class="navigasi-button">
						<input type="submit" name="button" id="button" value="Submit" />
						<input type="button" name="button" id="button" onclick="window.location='<?php echo X ?>pendapatan/data'" value="batal" />
						<input type="reset" name="reset" id="button" value="reset" />
					</div>
				</form>
			</div>
        </div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->