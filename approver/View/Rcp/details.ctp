<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h1 class="text-navy"><?php echo $detail['Rcp']['rcp_no'] ?></h1>
					<small><?php echo $detail['Department']['name'] ?> DEPARTMENT</small>
				</div>
				<div class="ibox-content ibox-heading">
					<h4>NOTE</h4>
					<small>1. BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code.</small><br>
					<small>2. To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.</small><br>
					<small>3. All alterations must be initialed by the authorized requesters / officers.</small><br>
					<small>4. Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right).</small><br>
					<small>5. All "RUSH" RCPs should be accompanied by an acceptable explanation.</small><br>
					<small>6. Qty, unit, particulars, BOM Ref / Acct Code, code and amount fields must not be empty. Make sure to fill at least one row to proceed.</small><br>
					<small>7. At least one row field must not be empty to generate the total amount in words.</small><br>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">
									<div class="col-md-3" data-select2-id="20">
										<h5>Approver</h5>
										<input class="form-control" disabled value="<?php echo $detail['User']['firstname'] . ' ' . $detail['User']['lastname'] ?>">
									</div>
									<div class="col-md-3" data-select2-id="20">
										<h5>Project</h5>
										<input class="form-control" disabled value="<?php echo $detail['Project']['name'] ?>">
									</div>
									<div class="col-md-4" data-select2-id="20">
										<h5>Company</h5>
										<input class="form-control" disabled value="<?php echo $detail['Company']['name'] ?>">
									</div>
									<div class="col-md-2" data-select2-id="20">
									<h5 id="expense_title"><?php echo $detail['Rcp']['expense_type'] ?></h5>
										<div>
											<span >
												<?php if ($detail['Rcp']['expense_type'] == "DEPARTMENT EXPENSE") : ?>
													<input type="checkbox" disabled class="expense_type switcher" data-switchery="true" style="display: none;">
												<?php else : ?>
													<input type="checkbox" disabled checked class="expense_type switcher" data-switchery="true" style="display: none;">
												<?php endif ?>
											</span>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">
									<div class="col-md-4" data-select2-id="20">
										<h5>Payee</h5>
										<input class="form-control" disabled value="<?php echo $detail['Rcp']['payee'] ?>">
									</div>
									<div class="col-md-8" data-select2-id="20">
										<h5>Amount in Words</h5>
										<input class="form-control" disabled value="<?php echo $detail['Rcp']['amount_in_words'] ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">
									<div class="col-md-12  no-padding" data-select2-id="20">
										<table class="table table-bordered table-responsive-md" id="rcp_table">
											<thead>
												<tr class="text-center">
													<th>QTY</th>
													<th>Unit</th>
													<th>Particulars</th>
													<th>BOM Ref / Acct Code</th>
													<?php if ($detail['Rcp']['expense_type'] == "DEPARTMENT EXPENSE") : ?>
														<th width="10%">Code</th>
													<?php endif ?>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($particulars as $particular) : ?>
												<tr>
													<td><?php echo $particular['RcpParticular']['qty'] ?></td>
													<td><?php echo $particular['RcpParticular']['unit'] ?></td>
													<td><?php echo $particular['RcpParticular']['particulars'] ?></td>
													<td><?php echo $particular['RcpParticular']['ref_code'] ?></td>
													<?php if ($detail['Rcp']['expense_type'] == "DEPARTMENT EXPENSE") : ?>
														<td><?php echo $particular['RcpParticular']['code'] ?></td>
													<?php endif ?>
													<td><?php echo CakeNumber::currency($particular['RcpParticular']['amount']) ?></td>
												</tr>
											<?php endforeach ?>
											</tbody>
										</table>
									</div>
									<div class="col-md-4" data-select2-id="20">
										<address>
											<div class="p-2">
												<strong>Payee:</strong> <?php echo $detail['Rcp']['payee'] ?><br>
												<strong>Due Date: </strong> <?php echo $detail['User']['firstname'] . ' ' . $detail['User']['lastname'] ?><br>
											</div>
										</address>
									</div>
									<div class="col-md-4" data-select2-id="20">
										<?php if ($detail['Rcp']['is_rush']) : ?>
											<div class="p-2">
												<strong>Status:</strong><span class="label label-danger ml-2">RUSH</span> <br>
												<strong>Due Date:</strong> <?php echo $rush['RcpRush']['due_date'] ?><br>
												<strong>Reason / Justification:</strong><br>
												<div class="well">
													<?php echo $rush['RcpRush']['justification'] ?>
												</div>
											</div>
										<?php else : ?>
											<div class="p-2">
												<strong>Status:</strong><span class="label label-warning ml-2">NOT RUSH</span><br>
												<strong>Due Date:</strong> ---<br>
												<strong>Reason / Justification: </strong>---<br>
											</div>
										<?php endif ?>
									</div>
									<div class="col-md-4 text-right" data-select2-id="20">
										<div>
											<span class="text-right">
											<h1 class="m-b-xs" id="amount"><?php echo CakeNumber::currency($detail['Rcp']['amount']) ?></h1>
												TOTAL AMOUNT DUE
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ibox-footer">
					<div class="text-right">
						<a href="<?php echo $this->params->webroot . 'feedback' ?>" class="btn btn-danger" id="return"><i class="fa fa-undo mr-2"></i> Return</a>
						<a href="<?php echo $this->params->webroot . 'approve' ?>" class="btn btn-primary" id="approve"><i class="fa fa-check-circle mr-2"></i> Approve</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		jsSwitch('.switcher', '#ED5565');
		rcpTable('#rcp_table', []);

		var rcpId = <?php echo $this->params->pass[0]?>;

		$('#return').on('click', function(event) {
			event.preventDefault();

			var url = $(this).attr('href');

			swal({
				title: "",
				text: "Reason or Justification:",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
			}, function (value) {
				if (value === "") {
					return swal.showInputError("Field required.");
				}
				else {
					$.ajax({
						type: 'POST',
						url: url,
						cache: false,
						data: {
							id: rcpId,
							feedback: value
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
			})
		})

		$('#approve').on('click', function(event) {
			event.preventDefault();

			var url = $(this).attr('href');

			swal({
				title: "",
				text: "Reason or Justification:",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
			}, function (value) {
				if (value === "") {
					return swal.showInputError("Field required.");
				}
				else {
					$.ajax({
						type: 'POST',
						url: url,
						cache: false,
						data: {
							id: rcpId,
							feedback: value
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
			})
		})
	})
</script>
