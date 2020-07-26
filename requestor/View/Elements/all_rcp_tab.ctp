<div role="tabpanel" id="tab-0" class="tab-pane active">
	<div class="panel-body">
		<table class="table table-bordered table-hover dataTables-example">
			<thead>
				<tr>
					<th>RCP No</th>
					<th>Department</th>
					<th>Project</th>
					<th>Company</th>
					<th>Approver</th>
					<th>Created</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($rcps as $rcp) : ?>
					<tr class="gradeX">
						<td><?php echo $rcp['Rcp']['rcp_no'] ?></td>
						<td><?php echo $rcp['Department']['name'] ?></td>
						<td><?php echo $rcp['Project']['name'] ?></td>
						<td><?php echo $rcp['Company']['name'] ?></td>
						<td><?php echo $rcp['User']['firstname'] ?></td>
						<td><?php echo $rcp['Rcp']['created'] ?></td>
						<td>
							<?php if ($rcp['Rcp']['status_id'] == 1) : ?>
								<span class="label label-warning"><small><?php echo $rcp['Status']['name'] ?></small></span>
							<?php elseif ($rcp['Rcp']['status_id'] == 2) : ?>
								<span class="label label-success"><small><?php echo $rcp['Status']['name'] ?></small></span>
							<?php else : ?>
								<span class="label label-danger"><small><?php echo $rcp['Status']['name'] ?></small></span>
							<?php endif ?>
						</td>
						<td>
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="<?php echo $this->params->webroot . 'details/' . $rcp['Rcp']['id'] ?>" class="text-navy" value="2"><i class="fa fa-file"></i><span class="nav-label"> Details</span></a>
								</li>
								<li class="breadcrumb-item">
									<a href="<?php echo $this->params->webroot . 'edit/' . $rcp['Rcp']['id'] ?>" class="text-danger" value="2"><i class="fa fa-pencil"></i><span class="nav-label"> Edit</span></a>
								</li>
							</ol>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
