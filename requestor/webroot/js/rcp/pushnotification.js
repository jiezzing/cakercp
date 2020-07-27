function pushNotification(userId = null, url = null) {
	var OneSignal =  window.OneSignal || [];

	OneSignal.push(function() {
		OneSignal.init({
			appId: "e986f8c5-25e9-4579-a96d-a611536dbbef",
			subdomainName: "your_label", /* The label for your site that you added in Site Setup mylabel.os.tc */
			promptOptions: {
			  /* Change bold title, limited to 30 characters */
			  siteName: 'OneSignal Documentation',
			  /* Subtitle, limited to 90 characters */
			  actionMessage: "We'd like to show you notifications for the latest news and updates.",
			  /* Example notification title */
			  exampleNotificationTitle: 'Example notification',
			  /* Example notification message */
			  exampleNotificationMessage: 'This is an example notification',
			  /* Text below example notification, limited to 50 characters */
			  exampleNotificationCaption: 'You can unsubscribe anytime',
			  /* Accept button text, limited to 15 characters */
			  acceptButtonText: "ALLOW",
			  /* Cancel button text, limited to 15 characters */
			  cancelButtonText: "NO THANKS",
			  autoAcceptTitle: 'Click Allow'
		  }
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
}
