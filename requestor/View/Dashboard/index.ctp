<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox ">
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo $tally['pending'] ?></h1>
					<div class="stat-percent font-bold text-warning"><i class="fa fa-level-up"></i></div>
					<small>Total # of pending RCP</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox ">
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo $tally['approved'] ?></h1>
					<div class="stat-percent font-bold text-success"><i class="fa fa-check"></i></div>
					<small>Total # of approved RCP</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox ">
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo $tally['declined'] ?></h1>
					<div class="stat-percent font-bold text-danger"><i class="fa fa-level-up"></i></div>
					<small>Total # of declined RCP</small>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox ">
				<div class="ibox-content">
					<h1 class="no-margins"><?php echo $tally['all'] ?></h1>
					<div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
					<small>Total # of RCP</small>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="tabs-container">
				<div class="tab-content">
					<div role="tabpanel" id="tab-0" class="tab-pane active">
						<div class="panel-body">
							<table class="table table-bordered table-hover dataTables-example">
								<thead>
									<tr>
										<th>RCP No</th>
										<th>Expense Type</th>
										<th>Approver</th>
										<th>Rush</th>
										<th>Created</th>
										<th>Status</th>
										<th>Progress</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($rcps as $rcp) : ?>
										<tr>
											<td><?php echo $rcp['Rcp']['rcp_no'] ?></td>
											<td><?php echo $rcp['Rcp']['expense_type'] ?></td>
											<td><?php echo $rcp['User']['firstname'] . ' ' . $rcp['User']['lastname']?></td>
											<?php if ($rcp['Rcp']['is_rush']) : ?>
											<td><span class="label label-danger"><small>Yes</small></span> </td>
											<?php else : ?>
											<td><span class="label label-primary"><small>No</small></span> </td>
											<?php endif ?>
											<td><?php echo $rcp['Rcp']['created'] ?></td>
											<td><span class="label label-warning"><small><?php echo $rcp['Status']['name'] ?></small></span> </td>
											<td>0 is to 4</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		dataTable('.table', [4, "desc"]);
	})
</script>


