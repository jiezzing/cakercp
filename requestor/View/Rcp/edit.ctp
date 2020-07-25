<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Request for Check Payment - Edit</h5>
				</div>
				<div class="ibox-content ibox-heading">
					<h4>NOTE</h4>
					<small>1. BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code.</small><br>
					<small>2. To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.</small><br>
					<small>3. All alterations must be initialed by the authorized requesters / officers.</small><br>
					<small>4. Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right).</small><br>
					<small>5. All "RUSH" RCPs should be accompanied by an acceptable explanation.</small><br>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-sm-12">
							<h1 class="text-navy"><?php echo $detail['Rcp']['rcp_no'] ?></h1>
							<address>
								<?php echo $detail['Department']['name'] ?> DEPARTMENT<br>
							</address>
						</div>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
                		<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">

									<div class="col-md-3" data-select2-id="20">
										<h5>Approver</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="approver" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option value="0">Select Department First</option>
										</select>
									</div>
									<div class="col-md-3" data-select2-id="20">
										<h5>Project</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="project" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<?php foreach ($projects as $project) : ?>
												<?php if ($detail['Rcp']['proj_id'] == $project['Project']['id']) : ?>
													<option value="<?php echo $project['Project']['id'] ?>" selected><?php echo $project['Project']['name'] ?></option>
												<?php else : ?>
													<option value="<?php echo $project['Project']['id'] ?>"><?php echo $project['Project']['name'] ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-4" data-select2-id="10">
										<h5>Company</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="company" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option value="0">Select Company</option>
											<?php foreach ($companies as $company) : ?>
												<?php if ($detail['Rcp']['comp_id'] == $company['Company']['id']) : ?>
													<option value="<?php echo $company['Company']['id'] ?>" selected><?php echo $company['Company']['name'] ?></option>
												<?php else : ?>
													<option value="<?php echo $company['Company']['id'] ?>"><?php echo $company['Company']['name'] ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-2" data-select2-id="20">
									<?php
										if ($detail['Rcp']['expense_type'] == 'PROJECT EXPENSE') {
											$expenseType = 'PROJECT EXPENSE';
											$checked = 'checked';
										}
										else {
											$expenseType = 'DEPARTMENT EXPENSE';
											$checked = '';
										}
									?>
									<h5 id="expense_title"><?php echo $expenseType ?></h5>
										<div>
											<span >
												<input type="checkbox" class="expense_type switcher" <?php echo $checked ?> data-switchery="true" style="display: none;" id="expense_type"">
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
									<div class="col-md-12" data-select2-id="20">
										<h5>Payee</h5>
										<input type="email" value="<?php echo $detail['Rcp']['payee'] ?>" placeholder="Payee" id="payee" class="form-control">
									</div>
								</div>
							</div>
                		</div>
					</div>
					<div class="row">
                		<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">
									<div class="col-md-12" data-select2-id="20">
										<h5>Amount in Words</h5>
										<input type="text" value="<?php echo $detail['Rcp']['amount_in_words'] ?>" disabled class="form-control text-center">
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
										<table class="table table-bordered table-responsive-md mt-3" id="rcp_table">
											<thead>
												<tr class="text-center">
													<th>QTY</th>
													<th>Unit</th>
													<th>Particulars</th>
													<th>BOM Ref / Acct Code</th>
													<th style="display: none">Code</th>
													<th>Amount</th>
													<th width="4%"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($particulars as $particular) : ?>
													<tr>
														<td class="qty" contenteditable="true"><?php echo $particular['RcpParticular']['qty'] ?></td>
														<td class="unit" contenteditable="true"><?php echo $particular['RcpParticular']['unit'] ?></td>
														<td class="particulars" contenteditable="true"><?php echo $particular['RcpParticular']['particulars'] ?></td>
														<td class="ref_code" contenteditable="true"><?php echo $particular['RcpParticular']['ref_code'] ?></td>
														<td class="code" contenteditable="true" style="display: none"><?php echo $particular['RcpParticular']['ref_code'] ?></td>
														<td class="amount" contenteditable="true"><?php echo $particular['RcpParticular']['amount'] ?></td>
														<td class="text-center"><span><i class="text-navy fa fa-check remove"></i></span></td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
									<div class="col-md-12 float-right" data-select2-id="20">
										<div>
											<span class="float-right">
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
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Show and fill up the following if this RCP is vatable</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-down"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content" style="display: none">
					<div class="col-md-12" data-select2-id="20">
						<select class="form-control select2-hidden-accessible chosen_select" data-select2-id="6" tabindex="-1" aria-hidden="true">
							<option data-select2-id="8"></option>
							<option value="Bahamas" data-select2-id="21">Bahamas</option>
							<option value="Bahrain" data-select2-id="22">Bahrain</option>
							<option value="Bangladesh" data-select2-id="23">Bangladesh</option>
							<option value="Barbados" data-select2-id="24">Barbados</option>
							<option value="Belarus" data-select2-id="25">Belarus</option>
							<option value="Belgium" data-select2-id="26">Belgium</option>
							<option value="Belize" data-select2-id="27">Belize</option>
							<option value="Benin" data-select2-id="28">Benin</option>
						</select>
					</div>
					<div class="col-md-12" data-select2-id="20">
						<table class="table table-bordered mt-3" id="rcp_table">
							<tbody>
								<tr>
									<td>P.O.S. Trans #</td>
									<td>---</td>
									<td>Less: VAT</td>
								</tr>
								<tr>
									<td>VATable Sales</td>
									<td>---</td>
									<td>Net: VAT</td>
								</tr>
								<tr>
									<td>VAT-Exempt</td>
									<td>---</td>
									<td>Less: SC/PWD Discount</td>
								</tr>
								<tr>
									<td>Zero Rated</td>
									<td>---</td>
									<td>Amount Due</td>
								</tr>
								<tr>
									<td>VAT Amount</td>
									<td>---</td>
									<td>Add: VAT</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>If RUSH, fill the following</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-down"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content" style="display: none">
					<div class="form-group" id="data_1">
						<label class="font-normal">Date</label>
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="rush_date" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="font-normal">Reason / Justification</label>
						<textarea class="form-control" placeholder="Your text here. . ." rows="5" id="justification"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var checked = $('#expense_type').prop("checked");
		var buttons = {
                text: 'Add New Row',
                action: function (e, dt, node, config) {
					var checked = $('#expense_type').prop("checked");
					var length = $('#rcp_table').find('td[class=qty]').length;
					var row = "";

					if (checked) {
						row = `<tr>
							<td class="qty" contenteditable="true"></td>
							<td class="unit" contenteditable="true"></td>
							<td class="particulars" contenteditable="true"></td>
							<td class="ref_code" contenteditable="true"></td>
							<td class="amount" contenteditable="true"></td>
							<td class="text-center">
								<a href="#">
									<span><i class="text-danger fa fa-trash remove"></i></span>
								</a>
							</td>
						</tr>`;
					}
					else {
						row = `<tr>
							<td class="qty" contenteditable="true"></td>
							<td class="unit" contenteditable="true"></td>
							<td class="particulars" contenteditable="true"></td>
							<td class="ref_code" contenteditable="true"></td>
							<td class="code" contenteditable="true"></td>
							<td class="amount" contenteditable="true"></td>
							<td class="text-center">
								<a href="#">
									<span><i class="text-danger fa fa-trash remove"></i></span>
								</a>
							</td>
						</tr>`;
					}

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

		$('#department').on('change', function(event) {
			event.preventDefault();

			var id = $('#department').val();
			var url = $(this).attr('url');

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					$('#approver').children().remove();
					$.each(response, function(index, value) {
						$('#approver').append(`<option value="${value.id}">${value.approver}</option>`).trigger("chosen:updated");
					})

				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			})
		})

		$('#expense_type').on('change', function(event) {
			event.preventDefault();

			var checked = $(this).prop("checked");
			var url = $(this).attr("url");

			if (checked) {
				$("#rcp_table tr td, th").filter(':nth-child(5)').hide();
				$('#expense_title').text("PROJECT EXPENSE");
			}
			else {
				$('#rcp_table > thead > tr > th:nth-child(5)').show();
				$("#rcp_table td").filter(':nth-child(5)').show();
				$('#expense_title').text("DEPARTMENT EXPENSE");
			}
		})

		$(document).on('click', '.remove', function(event) {
			event.preventDefault();

			$(this).parents("tr").remove();
		})
	});
</script>