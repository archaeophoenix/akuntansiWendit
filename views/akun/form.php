<!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Input Form Akun</div>
			</div>
			<div class="content-form">
				<form method="post" action="<?php echo X.'akun/upcreate/'.$data['id']; ?>">
					<table align="center" width="574" border="0">
						<tr>
							<td width="181">Nomor</td>
							<td width="373">
								<input style="width:250px; text-align:right" required="required" type="text" name="nama" value="<?php echo $data['nama'] ?>" />
								<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
							</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>
								<input style="width:250px;" required="required" type="text" name="belanja" value="<?php echo $data['belanja'] ?>" />
							</td>
						</tr>
						<tr>
							<td>Jenis</td>
							<td>
								<select name="id_jenis" required="required" id="jenis" style="width:250px;" class="select"></select>
								<input type="hidden" id="jns" value="<?php echo $data['id_jenis'] ?>">
							</td>
						</tr>
					</table>
					<div class="navigasi-button">
						<input type="submit" name="button" id="button" value="Submit" />
						<input type="button" name="button" id="button" onclick="window.location='<?php echo X ?>akun/data'" value="Batal" />
						<input type="reset" name="reset" id="button" value="reset" />
					</div>
				</form>
			</div>
        </div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->