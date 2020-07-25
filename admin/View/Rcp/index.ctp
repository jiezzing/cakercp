<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
			<div class="ibox-content">
				<table class="table table-bordered table-hover dataTables-example">
					<thead>
						<tr>
						<th><input type="checkbox" class="i-checks" name="input[]"></th>
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
								<td>
									<input type="checkbox" class="i-checks" name="input[]">
								</td>
								<td><?php echo $department['Department']['code'] ?></td>
								<td><?php echo $department['Department']['name'] ?></td>
								<td><?php echo $department['Department']['created'] ?></td>
								<td><?php echo $department['Department']['modified'] ?></td>
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
		var text = "Add Department";

		organizationTable('.table', text);
		iChecks('.i-checks');
	})
</script>
