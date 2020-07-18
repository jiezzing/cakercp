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
            'plugins/toastr/toastr.min.css',
            'style.css',
        ));

            // Main scripts
        echo $this->Html->script(array(
            'jquery-3.1.1.min.js',
			'bootstrap.js',
			'inspinia.js'
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
    <body class="gray-bg">
        <div id="wrapper">
			<?php
				echo $this->fetch('content');
			?>
        </div>
    </body>
</html>
