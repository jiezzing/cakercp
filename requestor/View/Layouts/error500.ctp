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

		echo $this->Html->css([
            'bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            'animate.css',
            'style.css'
        ]);

        echo $this->Html->script([

            // Main scripts
            'jquery-3.1.1.min.js',
            'popper.min.js',
            'bootstrap.js'
        ]);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
    <body class="gray-bg">
        <div class="middle-box text-center animated fadeInDown">
            <h1>500</h1>
            <h3 class="font-bold">Internal Server Error</h3>

            <div class="error-desc">
                The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
                You can go back to main page: <br/>
				<a href="<?php echo $this->params->webroot . 'dashboard' ?>"><button class="btn btn-primary m-t">Dashboard</button></a>
            </div>
        </div>
    </body>
</html>
