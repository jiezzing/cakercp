<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Edit Approvers</h5>
				</div>
				<div class="ibox-content">
					<div class="form-group  row"><label class="col-sm-2 col-form-label">Approvers</label>
						<div class="col-sm-5">
							<h5>Primary Approver</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="primary" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select</option>
								<?php foreach ($primaryApprovers as $value) : ?>
									<?php if ($value['User']['id'] == $departmentApprovers['Approver']['app_id']) : ?>
										<option selected value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php else : ?>
										<option value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-sm-5">
							<h5>Alternate Primary Approver</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="alternate-primary" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select</option>
								<?php foreach ($alternatePrimaryApprovers as $value) : ?>
									<?php if ($value['User']['id'] == $departmentApprovers['Approver']['alt_app_id']) : ?>
										<option selected value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php else : ?>
										<option value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group  row"><label class="col-sm-2 col-form-label"></label>
						<div class="col-sm-5">
							<h5>Secondary Approver</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="secondary" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select</option>
								<?php foreach ($secondaryApprover as $value) : ?>
									<?php if ($value['User']['id'] == $departmentApprovers['Approver']['sec_id']) : ?>
										<option selected value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php else : ?>
										<option value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-sm-5">
							<h5>Alternate Secondary Approver</h5>
							<select class="form-control select2-hidden-accessible chosen_select" id="alternate-secondary" data-select2-id="6" tabindex="-1" aria-hidden="true">
								<option value="0">Select</option>
								<?php foreach ($alternateSecondaryApprovers as $value) : ?>
									<?php if ($value['User']['id'] == $departmentApprovers['Approver']['alt_sec_id']) : ?>
										<option selected value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php else : ?>
										<option value="<?php echo $value['User']['id'] ?>"><?php echo $value['User']['firstname'] . ' ' . $value['User']['lastname'] ?></option>
									<?php endif ?>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="form-group row mt-5">
						<div class="col-sm-12 col-sm-offset-2">
							<a href="<?php echo $this->params->base . '/update_approver' ?>" class="btn btn-primary btn-sm float-right" id="update-approver">Update</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var id = <?php echo $this->params->pass[0] ?>;

		// initializations
		chosenSelect('.chosen_select');

		$('#update-approver').on('click', function(event) {
			event.preventDefault();

			var url = $(this).attr('href');
			var primary = $('#primary').val();
			var alternatePrimary = $('#alternate-primary').val();
			var secondary = $('#secondary').val();
			var alternateSecondary = $('#alternate-secondary').val();

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					id: id,
					primary: primary,
					alternatePrimary: alternatePrimary,
					secondary: secondary,
					alternateSecondary: alternateSecondary
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
