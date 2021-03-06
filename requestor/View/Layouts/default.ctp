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
		<?php echo $this->fetch('title') == 'Rcp' ? 'RCP' : $this->fetch('title') ?>
	</title>
	<?php echo $this->Html->meta('icon', 'img/ic_launcher-playstore.ico');

		echo $this->Html->css(array(
            'bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            'plugins/dataTables/datatables.min.css',
            'plugins/toastr/toastr.min.css',
            'style.css',
            'plugins/datapicker/datepicker3.css',
            'plugins/sweetalert/sweetalert.css',
            'plugins/chosen/bootstrap-chosen.css',
			'plugins/switchery/switchery.css',
        ));

        echo $this->Html->script(array(
            'jquery-3.1.1.min.js',
			'rcp/initialize.js',
			'rcp/currency.js',
            'popper.min.js',
			'bootstrap.js',
			'inspinia.js',
            'demo/sparkline-demo.js',
            'plugins/metisMenu/jquery.metisMenu.js',
            'plugins/slimscroll/jquery.slimscroll.min.js',
            'plugins/pace/pace.min.js',
            'plugins/dataTables/datatables.min.js',
            'plugins/dataTables/datatables.bootstrap4.min.js',
            'plugins/sparkline/jquery.sparkline.min.js',
            'plugins/toastr/toastr.min.js',
            'plugins/datapicker/bootstrap-datepicker.js',
            'plugins/sweetalert/sweetalert.min.js',
            'plugins/chosen/chosen.jquery.js',
			'plugins/switchery/switchery.js',
			'plugins/loading-overlay/dist/loadingoverlay.min.js',
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
<script>
	$(document).ready(function() {
		$('#logout_btn').on('click', function(event) {
			event.preventDefault();

			var url = $(this).attr('url');

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: null,
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						return window.location.href = response.url;
					}
					else {
						return toastr.error(response.message, response.type);
					}
				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			})
		})
	})
</script>
