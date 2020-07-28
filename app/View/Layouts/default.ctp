<!DOCTYPE html>
<html>
<head>
    <?php
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
		header("Expires: 0");

        echo $this->Html->charset();
    ?>
	<title>RCP</title>
	<?php echo $this->Html->meta('icon', 'img/ic_launcher-playstore.ico');

		echo $this->Html->css(array(
            'bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            'plugins/toastr/toastr.min.css',
            'style.css',
        ));

            // Main scripts
        echo $this->Html->script(array(
            'jquery-3.1.1.min.js',
            'popper.min.js',
			'bootstrap.js',
			'inspinia.js',

			// Plugins
            'plugins/metisMenu/jquery.metisMenu.js',
            'plugins/slimscroll/jquery.slimscroll.min.js',
            'plugins/toastr/toastr.min.js',

		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
	<body class="gray-bg">
		<div id="wrapper">
			<?php echo $this->fetch('content') ?>
		</div>
	</body>
</html>
