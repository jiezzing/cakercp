<?php echo $this->element('modals/department') ?>

<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
			<div class="ibox-content">
				<table class="table table-bordered table-hover dataTables-example">
					<thead>
						<tr>
							<th>Code</th>
							<th>Department</th>
							<th>Created</th>
							<th>Modified</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($departments as $department) : ?>
							<tr class="gradeX">
								<td><?php echo $department['Department']['code'] ?></td>
								<td><?php echo $department['Department']['name'] ?></td>
								<td><?php echo $department['Department']['created'] ?></td>
								<td><?php echo $department['Department']['modified'] ?></td>
								<td>
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?php echo $this->params->webroot . 'edit_department' ?>" class="text-navy _edit" value="<?php echo $department['Department']['id'] ?>"><i class="fa fa-pencil"></i><span class="nav-label"> Edit</span></a>
										</li>
										<li class="breadcrumb-item">
											<a href="<?php echo $this->params->webroot . 'delete_department' ?>" class="text-danger _delete" value="<?php echo $department['Department']['id'] ?>"><i class="fa fa-trash"></i><span class="nav-label"> Delete</span></a>
										</li>
									</ol>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var action = {
			text: "Add Department",
			action: function (e, dt, node, config) {
				$('#add_department_modal').modal("show");
			}
		}
		var globalId = null;
		var globalCode = null;
		var globalName = null;

		organizationTable('.table', action);
		iChecks('.i-checks');

		$('#add-department-btn').on('click', function(e) {
			e.preventDefault();

			var code = $('#add-code').val();
			var name = $('#add-name').val();
			var url = $(this).attr('href');

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					code: code,
					name: name
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#add_department_modal').modal('toggle');
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

		$(document).on('click', '._delete', function(e) {
			e.preventDefault();

			var id = $(this).attr('value');
			var url = $(this).attr('href');

			swal({
				title: "Confirmation",
				text: "Would you like to delete this department?",
				type: "info",
				showCancelButton: true,
				closeOnConfirm: true,
				confirmButtonText: "Yes",
				showLoaderOnConfirm: true
			}, function (response) {
				if (response) {
					$.ajax({
						type: 'POST',
						url: url,
						cache: false,
						data: {
							id: id
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
				}
				else {
					return false;
				}
			})
		})

		$(document).on('click', '._edit', function(e) {
			e.preventDefault();

			var id = $(this).attr('value');
			var url = $(this).attr('href');
			globalId = id;

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						globalCode = response.result.Department.code;
						globalName = response.result.Department.name;
						$('#edit-code').val(response.result.Department.code);
						$('#edit-name').val(response.result.Department.name);
						$('#edit_department_modal').modal('show');
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

		$('#edit-department-btn').on('click', function(e) {
			e.preventDefault();

			var url = $(this).attr('href');
			var code = $('#edit-code').val();
			var name = $('#edit-name').val();

			if (code == globalCode && name == globalName) {
				return $('#edit_department_modal').modal('toggle');
			}

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					id: globalId,
					code: code,
					name: name
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#edit_department_modal').modal('toggle');
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
	})
</script>
