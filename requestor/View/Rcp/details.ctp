<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content ibox-heading">
					<h4>NOTE</h4>
					<small>1. BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code.</small><br>
					<small>2. To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.</small><br>
					<small>3. All alterations must be initialed by the authorized requesters / officers.</small><br>
					<small>4. Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right).</small><br>
					<small>5. All "RUSH" RCPs should be accompanied by an acceptable explanation.</small><br>
				</div>
				<div class="ibox-content p-xl">
					<div class="row">
						<div class="col-sm-6">
							<h1 class="text-navy"><?php echo $detail['Rcp']['rcp_no'] ?></h1>
							<address>
								<strong>Payee:</strong> <?php echo $detail['Rcp']['payee'] ?><br>
								<strong>Approver: </strong> <?php echo $detail['User']['firstname'] . ' ' . $detail['User']['lastname'] ?><br><br>
								<strong>Department: </strong> <?php echo $detail['Department']['name'] ?><br>
								<strong>Company: </strong> <?php echo $detail['Company']['name'] ?><br>
								<strong>Project: </strong> <?php echo $detail['Project']['name'] ?><br><br>
								<span><strong>Expense Type:</strong> <?php echo $detail['Rcp']['expense_type'] ?></span><br>
								<span><strong>Issued on:</strong> <?php echo CakeTime::nice($detail['Rcp']['created']) ?></span><br>
							</address>
						</div>
						<div class="col-sm-6 text-right mt-5">
							<h5><?php echo CakeTime::nice($detail['Rcp']['created']) ?></h5><br>
							<h4 class="text-navy mt-3"><?php echo $detail['Rcp']['amount_in_words'] ?></h4>
							<table class="table invoice-total">
								<tbody>
								<tr>
									<td><strong>TOTAL AMOUNT DUE:</strong></td>
									<td><?php echo number_format((float) $detail['Rcp']['amount'], 2, '.', '') ?></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="table-responsive m-t">
						<table class="table invoice-table">
							<thead>
								<tr>
									<th>Particulars</th>
									<th>Unit</th>
									<th>QTY</th>
									<th>BOM Ref / Acct Code</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($particulars as $particular) : ?>
									<tr>
										<td><?php echo $particular['RcpParticular']['particulars'] ?></td>
										<td><?php echo $particular['RcpParticular']['unit'] ?></td>
										<td><?php echo $particular['RcpParticular']['qty'] ?></td>
										<td><?php echo $particular['RcpParticular']['ref_code'] ?></td>
										<td>₱ <?php echo number_format((float) $particular['RcpParticular']['amount'], 2, '.', '') ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<address>
								<strong>Payee:</strong> <?php echo $detail['Rcp']['payee'] ?><br>
								<strong>Due Date: </strong> <?php echo $detail['User']['firstname'] . ' ' . $detail['User']['lastname'] ?><br>
							</address>
						</div>
						<div class="col-sm-6 text-right">
							<?php if ($detail['Rcp']['is_rush']) : ?>
								<div class="media-body ">
									<strong>Status:</strong> RUSH<br>
									<strong>Due Date:</strong> 2020-08-20<br>
									<strong>Reason / Justification:</strong><br>
									<div class="well">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
										Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
									</div>
								</div>
							<?php else : ?>
								<div class="media-body ">
									<strong>Status:</strong> NOT RUSH<br>
									<strong>Due Date:</strong> ---------------<br>
									<strong>Reason / Justification: </strong>---------------<br>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="ibox-footer">
					<div class="text-right">
						<a href="<?php echo $this->params->base . '/edit/' . $detail['Rcp']['id'] ?>" class="btn btn-primary"><i class="fa fa-file mr-2"></i> Edit Details</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var buttons = {
                text: 'Add New Row',
                action: function (e, dt, node, config) {
					var length = $('#rcp_table').find('td[class=qty]').length;
					var row = 	`<tr>
									<td class="qty" contenteditable="true"></td>
									<td contenteditable="true"></td>
									<td contenteditable="true"></td>
									<td contenteditable="true"></td>
									<td contenteditable="true"></td>
									<td class="text-center">
										<a href="#">
											<span><i class="text-danger fa fa-trash remove"></i></span>
										</a>
									</td>
								</tr>`;

					if (length <= 13) {
						$('#rcp_table > tbody').append(row);
					}
					else {
						return toastr.error("Rows already exceeds the limit.");
					}
				}
            }

		// initializations
		chosenSelect('.chosen_select');
		jsSwitch('.switcher', '#ED5565');
		rcpTable('#rcp_table', buttons);
		datePicker('#data_1 .input-group.date');
	});
</script>
