<!DOCTYPE html>
<html>
<head>
    <?php
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
		header("Expires: 0");

        echo $this->Html->charset();
    ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php echo $this->Html->meta('icon', 'img/ic_launcher-playstore.ico');

		echo $this->Html->css(array(
            'bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            'plugins/dataTables/datatables.min.css',
            'plugins/toastr/toastr.min.css',
            'animate.css',
            'plugins/summernote/summernote-bs4.css',
            'style.css',
            'plugins/datapicker/datepicker3.css',
            'plugins/iCheck/custom.css',
            'plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
            'plugins/sweetalert/sweetalert.css',
            'custom.css',
            'plugins/select2/select2.min.css',
            'plugins/footable/footable.core.css',
            'plugins/jsTree/style.min.css',
            'plugins/ladda/ladda-themeless.min.css',
            'plugins/blueimp/css/blueimp-gallery.min.css',
            'plugins/jqGrid/ui.jqgrid.css',
            'plugins/chosen/bootstrap-chosen.css',
			'plugins/daterangepicker/daterangepicker-bs3.css',

			'plugins/switchery/switchery.css',
        ));

            // Main scripts
        echo $this->Html->script(array(
			'javascripts/initialize.js',
            'jquery-3.1.1.min.js',
            'popper.min.js',
			'bootstrap.js',
			'inspinia.js',

            'plugins/metisMenu/jquery.metisMenu.js',
            'plugins/slimscroll/jquery.slimscroll.min.js',
            'plugins/flot/jquery.flot.js',
            'plugins/flot/jquery.flot.tooltip.min.js',
            'plugins/flot/jquery.flot.spline.js',
            'plugins/flot/jquery.flot.resize.js',
            'plugins/flot/jquery.flot.pie.js',
            'plugins/peity/jquery.peity.min.js',
            'demo/peity-demo.js',
            'plugins/pace/pace.min.js',
            'plugins/summernote/summernote-bs4.js',
            'plugins/gritter/jquery.gritter.min.js',
            'plugins/dataTables/datatables.min.js',
            'plugins/dataTables/datatables.bootstrap4.min.js',
            'plugins/sparkline/jquery.sparkline.min.js',
            'demo/sparkline-demo.js',
            'plugins/toastr/toastr.min.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'plugins/iCheck/icheck.min.js',
            'plugins/sweetalert/sweetalert.min.js',
            'plugins/select2/select2.full.min.js',
            'plugins/footable/footable.all.min.js',
            'plugins/jsTree/jstree.min.js',
            'plugins/ladda/spin.min.js',
            'plugins/ladda/ladda.min.js',
            'plugins/ladda/ladda.jquery.min.js',
            'plugins/blueimp/jquery.blueimp-gallery.min.js',
            'plugins/jqGrid/jquery.jqGrid.min.js',
            'plugins/chosen/chosen.jquery.js',
            'plugins/fullcalendar/moment.min.js',
			'plugins/daterangepicker/daterangepicker.js',
			'plugins/switchery/switchery.js'
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
	<?php if (AuthComponent::user('id')) : ?>
		<body>
			<div class="pace  pace-inactive">
				<div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
				<div class="pace-progress-inner"></div>
				</div>
				<div class="pace-activity"></div>
			</div>
			<div id="wrapper">
				<?php echo $this->element('side_menu') ?>
				<div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 937px;">
					<?php
						echo $this->element('navbar');
						echo $this->element('header');
						echo $this->element('floating_cog');
						echo $this->fetch('content');
						echo $this->element('footer');
					?>
				</div>
			</div>
		</body>
	<?php else : ?>
		<body class="gray-bg">
			<div id="wrapper">
				<?php
					echo $this->fetch('content');
				?>
			</div>
		</body>
	<?php endif ?>
</html>
