<?php echo $this->element('modals/project') ?>

<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
			<div class="ibox-content">
				<table class="table table-bordered table-hover dataTables-example">
					<thead>
						<tr>
							<th>Code</th>
							<th>Project</th>
							<th>Created</th>
							<th>Modified</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($projects as $project) : ?>
							<tr class="gradeX">
								<td><?php echo $project['Project']['code'] ?></td>
								<td><?php echo $project['Project']['name'] ?></td>
								<td><?php echo $project['Project']['created'] ?></td>
								<td><?php echo $project['Project']['modified'] ?></td>
								<td>
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="#" class="text-navy" value="2"><i class="fa fa-pencil"></i><span class="nav-label"> Edit</span></a>
										</li>
										<li class="breadcrumb-item">
											<a href="#" class="text-danger" value="2"><i class="fa fa-trash"></i><span class="nav-label"> Delete</span></a>
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
			text: "Add Project",
			action: function (e, dt, node, config) {
				$('#add_project_modal').modal("show");
			}
		}

		organizationTable('.table', action);
		iChecks('.i-checks');
	})
</script>
