 <!-- Main content -->
<div class="container" role="main">
	<!-- Main data container -->
	<div class="content">
		<div class="page-container tab-content">
			<div class="header-tabel">
				<div class="title-tabel">Input Form Transaksi Pendapatan</div>
			</div>
			<div class="content-form">
				<form method="post" action="<?php echo X.'pendapatan/jurnal/'.$val['id_pemasukan'] ?>">
					<table width="574" border="0" align="center">
						<tr>
							<td width="181">Keterangan</td>
							<td width="373">
								<?php echo $data['nama'] ?>
								<input type="hidden" name="keterangan" value="<?php echo $data['nama'] ?>"/>
								<input type="hidden" name="id_pendapatan" value="<?php echo $data['id'] ?>"/>
								<input type="hidden" name="id_transaksi" value="<?php echo $val['id_transaksi'] ?>"/>
							</td>
						</tr>
						<tr>
							<td>Bayar Untuk Tanggal</td>
							<td>
								<select name="bulan" class="select" style="height: 24px; width: 120px">
									<?php foreach ($bulan as $value){ ?>
									<option <?php echo ($bln == $value['angka']) ? 'selected="selected"' : '' ; ?> value="<?php echo $value['angka'] ?>"><?php echo $value['bulan'] ?></option>
									<?php } ?>
								</select>
								<select name="tahun" class="select" style="height: 24px; width: 80px">
									<?php foreach ($tahun as $value){ ?>
										<option <?php echo ($thn == $value) ? 'selected="selected"' : '' ; ?> value="<?php echo $value ?>"><?php echo $value ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Nilai</td>
							<td>
								<input type="text" name="nilai" class="number" value="<?php echo $val['nilai'] ?>" required="required" pattern="\d+" style="width: 190px; text-align:right" placeholder="X0000"/>
							</td>
						</tr>
						<tr>
							<td>Debet</td>
							<td>
								<?php echo $data['dbt'] ?>
								<input type="hidden" name="debet" value="<?php echo $data['debet'] ?>">
								<input type="hidden" name="id_debet" value="<?php echo $val['id_debet'] ?>">
							</td>
						</tr>
						<tr>
							<td>Kredit</td>
							<td>
								<?php echo $data['krt'] ?>
								<input type="hidden" name="kredit" value="<?php echo $data['kredit'] ?>">
								<input type="hidden" name="id_kredit" value="<?php echo $val['id_kredit'] ?>">
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