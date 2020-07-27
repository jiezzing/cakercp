<!DOCTYPE html>
<html>
<head>
	<?php if (AuthComponent::user('id')) : ?>
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
		var userId = <?php echo AuthComponent::user('id') ?>;
		var url = "<?php echo $this->params->webroot . 'update_player_id' ?>";
		var OneSignal =  window.OneSignal || [];

		OneSignal.push(function() {
			OneSignal.init({
				appId: "e986f8c5-25e9-4579-a96d-a611536dbbef"
			});

			OneSignal.on('customPromptClick', function(promptClickResult) {
				if (promptClickResult.result == "denied") {
					toastr.error("You must enable the PUSH NOTIFICATION to receive real-time notifications. ", "Error")
				}
				console.log('HTTP Pop-Up Prompt click result:', promptClickResult);
			});

			OneSignal.on('subscriptionChange', function (isSubscribed) {
				console.log("The user's subscription state is now:", isSubscribed);
				OneSignal.sendTag("user_id", userId, function(tagsSent) {
					console.log("Tags has finished sending:", tagsSent);
				});

				if (isSubscribed == true) {
					OneSignal.getUserId().then(function(playerId) {
						console.log("Player ID: " + playerId)
						$.ajax({
							type: 'POST',
							url: url,
							cache: false,
							data: {
								id: userId,
								playerId: playerId
							},
							dataType: 'json',
							success: function(response) {
								if (response.status) {
									return toastr.success(response.message, response.type)
								}
								else {
									return toastr.error(response.message, response.type)
								}
							},
							error: function (response, desc, exception) {
								alert(exception);
							}
						})
					})
				}


			});

			var isPushSupported = OneSignal.isPushNotificationsSupported();

			if (isPushSupported) {
				OneSignal.isPushNotificationsEnabled(function(isEnabled) {
					if (isEnabled) {
						console.log("Push notifications are enabled!");
					}

					else {
						OneSignal.registerForPushNotifications();
						console.log("Push notifications are not enabled yet.");
					}
				});
			} else {
				alert("Push notifications are not supported");
			}
		});
	</script>
	<?php endif ?>
    <?php
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
		header("Expires: 0");

        echo $this->Html->charset();
    ?>
	<title>
		<?php echo $this->fetch('title') ?>
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
						if ($this->params->controller == 'dashboard') {
							echo $this->element('sidebar_panel');
						}
						echo $this->element('header');
						if ($this->params->controller == "rcp") {
							echo $this->element('floating_cog');
						}
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
