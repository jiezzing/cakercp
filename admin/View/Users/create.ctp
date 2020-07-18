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
							<input type="text" placeholder="Firstname" class="form-control">
						</div>
						<div class="col-sm-4">
							<h5>Lastname</h5>
							<input type="text" placeholder="Lastname" class="form-control">
						</div>
						<div class="col-sm-2">
							<h5>Middle Initial</h5>
							<input type="text" placeholder="Middle Initial (optional)" class="form-control">
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label">Organizations</label>
						<div class="col-sm-5">
							<h5>Department</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option data-select2-id="8"></option>
								<option value="Bahamas" data-select2-id="21">Bahamas</option>
								<option value="Bahrain" data-select2-id="22">Bahrain</option>
								<option value="Bangladesh" data-select2-id="23">Bangladesh</option>
								<option value="Barbados" data-select2-id="24">Barbados</option>
								<option value="Belarus" data-select2-id="25">Belarus</option>
								<option value="Belgium" data-select2-id="26">Belgium</option>
								<option value="Belize" data-select2-id="27">Belize</option>
								<option value="Benin" data-select2-id="28">Benin</option>
							</select>
						</div>
						<div class="col-sm-5">
							<h5>Project</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option data-select2-id="8"></option>
								<option value="Bahamas" data-select2-id="21">Bahamas</option>
								<option value="Bahrain" data-select2-id="22">Bahrain</option>
								<option value="Bangladesh" data-select2-id="23">Bangladesh</option>
								<option value="Barbados" data-select2-id="24">Barbados</option>
								<option value="Belarus" data-select2-id="25">Belarus</option>
								<option value="Belgium" data-select2-id="26">Belgium</option>
								<option value="Belize" data-select2-id="27">Belize</option>
								<option value="Benin" data-select2-id="28">Benin</option>
							</select>
						</div>
					</div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-10">
							<h5>Company</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option data-select2-id="8"></option>
								<option value="Bahamas" data-select2-id="21">Bahamas</option>
								<option value="Bahrain" data-select2-id="22">Bahrain</option>
								<option value="Bangladesh" data-select2-id="23">Bangladesh</option>
								<option value="Barbados" data-select2-id="24">Barbados</option>
								<option value="Belarus" data-select2-id="25">Belarus</option>
								<option value="Belgium" data-select2-id="26">Belgium</option>
								<option value="Belize" data-select2-id="27">Belize</option>
								<option value="Benin" data-select2-id="28">Benin</option>
							</select>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label">Account Information</label>
						<div class="col-sm-4">
							<h5>Username</h5>
							<input type="text" placeholder="Username" class="form-control">
						</div>
						<div class="col-sm-4">
							<h5>Email Address</h5>
							<input type="text" placeholder="Email Address (optional)" class="form-control">
						</div>
						<div class="col-sm-2">
							<h5>Type</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option data-select2-id="8"></option>
								<option value="Bahamas" data-select2-id="21">Bahamas</option>
								<option value="Bahrain" data-select2-id="22">Bahrain</option>
								<option value="Bangladesh" data-select2-id="23">Bangladesh</option>
								<option value="Barbados" data-select2-id="24">Barbados</option>
								<option value="Belarus" data-select2-id="25">Belarus</option>
								<option value="Belgium" data-select2-id="26">Belgium</option>
								<option value="Belize" data-select2-id="27">Belize</option>
								<option value="Benin" data-select2-id="28">Benin</option>
							</select>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group row">
						<div class="col-sm-12 col-sm-offset-2">
							<button class="btn btn-primary btn-sm float-right" type="submit">Register User</button>
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
	});
</script>
