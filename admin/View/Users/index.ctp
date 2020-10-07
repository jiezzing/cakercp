<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
			<div class="ibox-content">
				<table class="table table-bordered table-hover table-responsive dataTables-example">
					<thead>
						<tr>
						<th><input type="checkbox" class="i-checks" name="input[]"></th>
							<th>Name</th>
							<th>Department</th>
							<th>Company</th>
							<th>Project</th>
							<th>Type</th>
							<th>Username</th>
							<th>Password</th>
							<th>Email Address</th>
							<th>Log Count</th>
							<th>Created</th>
							<th>Modified</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $user) : ?>
							<tr class="gradeX">
								<td>
									<input type="checkbox" class="i-checks" name="input[]">
								</td>
								<td><?php echo $user['User']['lastname'] . ', ' . $user['User']['firstname'] ?></td>
								<td><?php echo $user['Department']['name'] ?></td>
								<td><?php echo $user['Company']['name'] ?></td>
								<td><?php echo $user['Project']['name'] ?></td>
								<td><?php echo $user['UserType']['name'] ?></td>
								<td><?php echo $user['UserAccount']['username'] ?></td>
								<td><?php echo $user['UserAccount']['password'] ?></td>
								<td><?php echo $user['UserAccount']['email'] ?></td>
								<td><?php echo $user['UserAccount']['log_count'] ?></td>
								<td><?php echo $user['User']['created'] ?></td>
								<td><?php echo $user['User']['modified'] ?></td>
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
			text: "Add User",
			action: function (e, dt, node, config) {
				window.location.href = location.href + "/create";
			}
		}

		organizationTable('.table', action);
		iChecks('.i-checks');
	})
</script>
