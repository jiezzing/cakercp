<div role="tabpanel" id="tab-3" class="tab-pane">
	<div class="panel-body">
		<table class="table table-bordered table-hover dataTables-example">
			<thead>
				<tr>
					<th>RCP No</th>
					<th>Department</th>
					<th>Project</th>
					<th>Company</th>
					<th>Approver</th>
					<th>Issued</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($declined as $rcp) : ?>
					<tr class="gradeX">
						<td><?php echo $rcp['Rcp']['rcp_no'] ?></td>
						<td><?php echo $rcp['Department']['name'] ?></td>
						<td><?php echo $rcp['Project']['name'] ?></td>
						<td><?php echo $rcp['Company']['name'] ?></td>
						<td><?php echo $rcp['User']['firstname'] ?></td>
						<td><?php echo $rcp['Rcp']['issued_on'] ?></td>
						<td><?php echo $rcp['Rcp']['created'] ?></td>
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
