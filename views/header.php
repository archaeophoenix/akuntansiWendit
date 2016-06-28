<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Akuntansi - <?php echo $sesi ?></title>
		<link rel="icon" href="<?php echo X.'public/images/'?>ico.ico" type="image/x-icon" />
		<!-- CSS styles -->
		<link rel="stylesheet" type="text/css" href="<?php echo X ?>public/css/layout.css">
	</head>
	<body>
		<header class="navbar navbar-fixed-top affix-top">
			<div class="navbar-inner">
				<div class="container">
					<div  style="float:left; padding-top:5px; width:150px; height:40px;">
						<img src="<?php echo X ?>public/images/wekwek.png" width="150" height="40">
					</div>					
					<div class="nav-collapse">
						<!-- Menu Navigasi -->
						<nav class="navigation">
							<ul class="nav active-arrows" role="navigation">
								
								<?php if ($_SESSION['status'] == 3){?>
								<li <?php echo $jurnal ?>>
									<a href="<?php echo X ?>jurnal/data" title="Jurnal">
										<span class="awe-font"></span>
										Jurnal
									</a>
								</li>

								<li <?php echo $pendapatan ?>>
									<a href="<?php echo X ?>pendapatan/data" title="Pendapatan">
										<span class="awe-font"></span>
										Pendapatan
									</a>
								</li>

								<li <?php echo $akun ?>>
									<a href="<?php echo X ?>akun/data" title="Akun" >
										<span class="awe-tasks"></span>
										Akun
									</a>
								</li>
								<?php } ?>
								
								<?php if ($_SESSION['status'] != 1){?>
                                <li <?php echo $report ?>>
									<a class="dropdown-toggle" data-toggle="dropdown" title="Laporan" href="#" >
										<div><span class="awe-magic"></span>Laporan</div>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a title="Laporan Jurnal" href="<?php echo X ?>laporan/lapor/jurnal"><span class="awe-flag"></span>Jurnal</a></li>
										<li><a title="Laporan Per Akun" href="<?php echo X ?>laporan/lapor/perakun"><span class="awe-flag"></span>Per Akun</a></li>
										<li><a title="Laporan Laba Rugi" href="<?php echo X ?>laporan/lapor/labarugi"><span class="awe-flag"></span>Laba Rugi</a></li>
										<li><a title="Laporan Neraca" href="<?php echo X ?>laporan/lapor/neraca"><span class="awe-flag"></span>Neraca</a></li>
									</ul>
								</li>
								<?php } ?>
								
								<?php if ($_SESSION['status'] == 2){?>
								<li <?php echo $log ?>>
									<a href="<?php echo X ?>log/" title="Aktivitas Pegawai" >
										<span class="awe-table"></span>
										Aktivitas Pegawai
									</a>
								</li>
								<?php } ?>

								<?php if ($_SESSION['status'] == 1){?>
								<li <?php echo $user ?>>
									<a href="<?php echo X ?>user/data" title="User" >
										<span class="awe-table"></span>
										User
									</a>
								</li>
								<?php } ?>

							</ul>
						</nav>
						
						<!-- User navigation -->
						<nav class="user">
							<div class="user-info pull-right">
								<div class="btn-group"  style="margin-top:0px; padding-top:5px;" >
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="http://template.walkingpixels.com/wuxia/tables.html#"  style=" margin-top:0px;">
										<div>
											<strong><?php echo $_SESSION['nama'] ?></strong>
											<?php switch ($_SESSION['status']) {
												case 1:
													echo "Admin";
												break;
												case 2:
													echo "Pimpinan";
												break;
												case 3:
													echo "Pegawai";
												break;
											} ?>
										</div>
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										
										<?php if ($_SESSION['status'] != 1){?>
										<li><a href="<?php echo X ?>profile"><span class="awe-cogs"></span> Profile</a></li>
										<?php } ?>

										<li><a href="<?php echo X ?>logout"><span class="awe-signout"></span> Logout</a></li>
									</ul>
								</div>
							</div>
						</nav>

					</div>
				</div>
			</div>
		</header>
		<!-- /Main navigation bar -->