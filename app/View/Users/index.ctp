<div class="middle-box text-center loginscreen animated">
	<div>
		<div>

			<h1 class="logo-name">RCP</h1>

		</div>
		<h3>Request for Check Payment</h3>
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Username" id="username" required="">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" id="password" required="">
			</div>
			<a href="<?php echo $this->params->base . '/login_user' ?>" class="btn btn-primary block full-width m-b" id="login_btn">Login</a>

			<a href="#"><small>Forgot password?</small></a>
		</form>
		<p class="m-t"> <small>Innoland Development Corp. &copy; <?php echo $currentYear ?></small> </p>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#login_btn').on('click', function(event) {
			event.preventDefault();

			var  url = $(this).attr('href');
			var  username = $('#username').val().trim();
			var  password = $('#password').val().trim();

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					username: username,
					password: password
				},
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
