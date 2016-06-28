		<input type="hidden" id="id_">
		<input type="hidden" id="page">
		<input type="hidden" id="base" value="<?php echo X ?>">
		<input type="hidden" id="thn" value="<?php echo date('Y') ?>">
		<input type="hidden" id="bln" value="<?php echo date('m') ?>">

		<!-- Main footer -->
		<footer class="container" style="clear:both; text-align:center; padding:10px 0px;">
			© Copyright <?php echo date('Y') ?> AAH-BBS. All rights reserved.
		</footer>

		<!-- CSS styles -->
		<link rel="stylesheet" href="<?php echo X ?>public/css/jquery.ui.theme.css">
		<link rel="stylesheet" href="<?php echo X ?>public/css/jquery.ui.datepicker.css">
		<link rel="stylesheet" type="text/css" href="<?php echo X ?>public/css/select2.css">
		
		<!-- JS Libs -->
		<script src="<?php echo X ?>public/js/jquery.min.js"></script>
		<script src="<?php echo X ?>public/js/jquery-ui.min.js"></script>
		<script src="<?php echo X ?>public/js/select2.min.js"></script>
		<script src="<?php echo X ?>public/js/menu.js"></script>
		<?php echo $js ?>
	</body>
</html>