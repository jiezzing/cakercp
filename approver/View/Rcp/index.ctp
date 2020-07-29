<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="row">
					<div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link active" data-toggle="tab" href="#tab-0">All RCP</a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab-1"><span class="label label-warning">Pending</span></a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab-2"><span class="label label-success">Approved</span></a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab-3"><span class="label label-danger">Declined</span></a></li>
							</ul>
							<div class="tab-content">
							<div role="tabpanel" id="tab-0" class="tab-pane active">
								<div class="panel-body">
									<table class="table table-bordered table-hover dataTables-example">
										<thead>
											<tr>
												<th>RCP No</th>
												<th>Department</th>
												<th>Project</th>
												<th>Company</th>
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
							<div role="tabpanel" id="tab-1" class="tab-pane">
								<div class="panel-body">
									<table class="table table-bordered table-hover dataTables-example">
										<thead>
											<tr>
												<th>RCP No</th>
												<th>Department</th>
												<th>Project</th>
												<th>Company</th>
												<th>Issued</th>
												<th>Created</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($pending as $rcp) : ?>
												<tr class="gradeX">
													<td><?php echo $rcp['Rcp']['rcp_no'] ?></td>
													<td><?php echo $rcp['Department']['name'] ?></td>
													<td><?php echo $rcp['Project']['name'] ?></td>
													<td><?php echo $rcp['Company']['name'] ?></td>
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
							<div role="tabpanel" id="tab-2" class="tab-pane">
								<div class="panel-body">
									<table class="table table-bordered table-hover dataTables-example">
										<thead>
											<tr>
												<th>RCP No</th>
												<th>Department</th>
												<th>Project</th>
												<th>Company</th>
												<th>Issued</th>
												<th>Created</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($approved as $rcp) : ?>
												<tr class="gradeX">
													<td><?php echo $rcp['Rcp']['rcp_no'] ?></td>
													<td><?php echo $rcp['Department']['name'] ?></td>
													<td><?php echo $rcp['Project']['name'] ?></td>
													<td><?php echo $rcp['Company']['name'] ?></td>
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
							<div role="tabpanel" id="tab-3" class="tab-pane">
								<div class="panel-body">
									<table class="table table-bordered table-hover dataTables-example">
										<thead>
											<tr>
												<th>RCP No</th>
												<th>Department</th>
												<th>Project</th>
												<th>Company</th>
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

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		dataTable('.table');
		iChecks('.i-checks');
	})
</script>


