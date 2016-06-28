<!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Input Form User</div>
			</div>
			<div class="content-form">
				<form method="post" action="<?php echo X.'user/upcreate/'.$data['id']; ?>">
					<table align="center" width="574" border="0">
						<tr>
							<td width="181">Nama</td>
							<td width="373">
								<input style="width:250px;" required="required" type="text" name="nama" value="<?php echo $data['nama'] ?>" />
								<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
							</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>
								<input style="width:250px;" required="required" type="text" name="username" value="<?php echo $data['username'] ?>" />
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>
								<input style="width:250px;" type="password" name="password"/>
							</td>
						</tr>
						<?php if ($_SESSION['status'] == 1) {?>
						<tr>
							<td>Status</td>
							<td>
								<select name="status" required="required" id="jenis" style="width:263px;" class="select">
									<option value="0" <?php echo ($data['status'] == 0) ? 'selected="selected"' : '' ; ?>>Tidak Aktiv</option>
									<option value="1" <?php echo ($data['status'] == 1) ? 'selected="selected"' : '' ; ?>>Admin</option>
									<option value="2" <?php echo ($data['status'] == 2) ? 'selected="selected"' : '' ; ?>>Pimpinan</option>
									<option value="3" <?php echo ($data['status'] == 3) ? 'selected="selected"' : '' ; ?>>Pegawai</option>
								</select>
							</td>
						</tr>
						<?php } ?>
					</table>
					<div class="navigasi-button">
						<input type="submit" id="button" value="Submit" />
						<input type="button" id="button" onclick="window.location='<?php echo X ?>user/data'" value="Batal" />
						<input type="reset" id="button" value="reset" />
					</div>
				</form>
			</div>
        </div>
	</div>
	<!-- /Main data container -->
</div>
<!-- /Main content -->