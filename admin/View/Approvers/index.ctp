<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
			<div class="ibox-content">
				<table class="table table-bordered table-hover dataTables-example">
					<thead>
						<tr>
							<th>Department</th>
							<th>Primary</th>
							<th>Alternate Primary</th>
							<th>Secondary</th>
							<th>Alternate Secondary</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($departments as $key => $value) : ?>
							<tr class="gradeX">
								<td><?php echo $value['Department']['name'] ?></td>
								<td><?php echo $primaryApprovers[$key]['firstname'] . ' ' . $primaryApprovers[$key]['lastname'] ?></td>
								<td><?php echo $alternatePrimaryApprovers[$key]['firstname'] . ' ' . $alternatePrimaryApprovers[$key]['lastname'] ?></td>
								<td><?php echo $secondaryApprovers[$key]['firstname'] . ' ' . $secondaryApprovers[$key]['lastname'] ?></td>
								<td><?php echo $alternateSecondaryApprovers[$key]['firstname'] . ' ' . $alternateSecondaryApprovers[$key]['lastname'] ?></td>
								<td>
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="<?php echo $this->params->webroot . 'edit/' . $value['Department']['id'] ?>" class="text-navy" value="2"><i class="fa fa-pencil"></i><span class="nav-label"> Edit</span></a>
										</li>
										<li class="breadcrumb-item">
											<a href="<?php echo $this->params->webroot . 'remove' ?>" class="text-danger remove" value="<?php echo $value['Department']['id'] ?>"><i class="fa fa-trash"></i><span class="nav-label"> Remove</span></a>
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
		dataTable('.table', [0, "asc"]);

		$(document).on('click', '.remove', function(e) {
			e.preventDefault();

			var id = $(this).attr('value');
			var url = $(this).attr('href');

			swal({
				title: "Confirmation",
				text: "Would you like to remove all approvers in this department?",
				type: "info",
				showCancelButton: true,
				closeOnConfirm: true,
				confirmButtonText: "Yes",
				showLoaderOnConfirm: true
			}, function (response) {
				if (response) {
				var request = $.ajax({
					type: 'POST',
					url: url,
					cache: false,
					data: { id: id},
					dataType: 'json',
					success: function(response) {
						if (response.status) {
							return toastr.success(response.message, response.rcp_no)
						}
						else {
							return toastr.error(response.message, response.type)
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
	})
</script>
