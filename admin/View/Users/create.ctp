<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Add New User <small>Fill-up Form</small></h5>
				</div>
				<div class="ibox-content ibox-heading">
					<h4>NOTE</h4>
					<small>1. Default password is the registered username.</small><br>
					<small>2. Passwords can be changed by the user during first login.</small><br>
				</div>
				<div class="ibox-content">
					<div class="form-group  row"><label class="col-sm-2 col-form-label">Personal Information</label>
						<div class="col-sm-4">
							<h5>Firstname</h5>
							<input type="text" placeholder="Firstname" class="form-control" id="firstname">
						</div>
						<div class="col-sm-4">
							<h5>Lastname</h5>
							<input type="text" placeholder="Lastname" class="form-control" id="lastname">
						</div>
						<div class="col-sm-2">
							<h5>Middle Initial</h5>
							<input type="text" placeholder="Middle Initial (optional)" class="form-control" id="middle_initial">
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label">Organizations</label>
						<div class="col-sm-5">
							<h5>Department</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select Department</option>
								<?php foreach ($departments as $department) : ?>
									<option value="<?php echo $department['Department']['id'] ?>"><?php echo $department['Department']['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-sm-5">
							<h5>Project</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="project" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select Project</option>
								<?php foreach ($projects as $project) : ?>
									<option value="<?php echo $project['Project']['id'] ?>"><?php echo $project['Project']['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<h5>Company</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="company" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select Company</option>
								<?php foreach ($companies as $company) : ?>
									<option value="<?php echo $company['Company']['id'] ?>"><?php echo $company['Company']['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label">Account Information</label>
						<div class="col-sm-4">
							<h5>Username</h5>
							<input type="text" placeholder="Username" class="form-control" id="username">
						</div>
						<div class="col-sm-4">
							<h5>Email Address</h5>
							<input type="text" placeholder="Email Address (optional)" class="form-control" id="email_address">
						</div>
						<div class="col-sm-2">
							<h5>Type</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="user_type" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select Type</option>
								<?php foreach ($userTypes as $userType) : ?>
									<option value="<?php echo $userType['UserType']['id'] ?>"><?php echo $userType['UserType']['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group row">
						<div class="col-sm-12 col-sm-offset-2">
							<a href="<?php echo $this->params->base . '/' . $this->params->controller . '/registerUser' ?>" class="btn btn-primary btn-sm float-right" type="submit" id="register_btn">Register User</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// initializations
		chosenSelect('.chosen_select');

		$('#register_btn').on('click', function(event) {
			event.preventDefault();

			var url = $(this).attr('href');
			var firstname = $('#firstname').val().trim();
			var lastname = $('#lastname').val().trim();
			var middleInitial = $('#middle_initial').val().trim();
			var department = $('#department').val();
			var project = $('#project').val();
			var company = $('#company').val();
			var userType = $('#user_type').val();
			var username = $('#username').val().trim();
			var email = $('#email_address').val().trim();

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					firstname: firstname,
					lastname: lastname,
					middleInitial: middleInitial,
					department: department,
					project: project,
					company: company,
					userType: userType,
					username: username,
					email: email
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						return toastr.success(response.message, response.type);
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
	});
</script>
