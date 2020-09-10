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
									<h5 id="expense_title"><?php echo $detail['Rcp']['expense_type'] ?></h5>
										<div>
											<span >
												<?php if ($detail['Rcp']['expense_type'] == "DEPARTMENT EXPENSE") : ?>
													<input type="checkbox" class="expense_type switcher" data-switchery="true" style="display: none;" id="expense_type">
												<?php else : ?>
													<input type="checkbox" checked class="expense_type switcher" data-switchery="true" style="display: none;" id="expense_type">
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
										<input type="email" value="<?php echo $detail['Rcp']['payee'] ?>" placeholder="Payee" id="payee" class="form-control">
									</div>
									<div class="col-md-8" data-select2-id="20">
										<h5>Amount in Words</h5>
										<input type="text" placeholder="NO TOTAL AMOUNT DETECTED (Auto Generated)" value="<?php echo $detail['Rcp']['amount_in_words'] ?>" disabled class="form-control text-center" id="amount_in_words">
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
													<th width="10%">Code</th>
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
													<?php if ($detail['Rcp']['expense_type'] == "DEPARTMENT EXPENSE") : ?>
														<td class="code" contenteditable="true"><?php echo $particular['RcpParticular']['code'] ?></td>
													<?php else : ?>
														<td class="code" contenteditable="true"></td>
													<?php endif ?>
													<td class="amount" contenteditable="true"><?php echo $particular['RcpParticular']['amount'] ?></td>
													<td class="text-center"><span><i class="text-navy fa fa-check"></i></span></td>
												</tr>
											<?php endforeach ?>
											<?php if (count($particulars) < 5) : ?>
												<?php for ($i = count($particulars); $i < 5; $i++) : ?>
													<tr>
													<td class="qty" contenteditable="true"></td>
													<td class="unit" contenteditable="true"></td>
													<td class="particulars" contenteditable="true"></td>
													<td class="ref_code" contenteditable="true"></td>
													<td class="code" contenteditable="true"></td>
													<td class="amount" contenteditable="true"></td>
													<td class="text-center"><span><i class="text-navy fa fa-check"></i></span></td>
													</tr>
												<?php endfor ?>
											<?php endif ?>
											</tbody>
										</table>
									</div>
									<div class="col-md-12 float-right" data-select2-id="20">
										<div>
											<span class="float-right">
											<h1 class="m-b-xs" id="amount">₱<?php echo number_format($detail['Rcp']['amount'], 2) ?></h1>
												TOTAL AMOUNT DUE
											</span>
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
								</div>
								<div class="ibox-content">
									<div class="col-md-12" data-select2-id="20">
										<select class="form-control select2-hidden-accessible chosen_select" id="vat" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<?php foreach ($vatables as $vatable) : ?>
												<?php if ($vatable['Vat']['id'] == $vat['RcpVatable']['vat_id']) : ?>
													<?php if ($vatable['Vat']['id'] != 4) : ?>
														<option selected id="<?php echo $vatable['Vat']['id'] ?>" value="<?php echo $vatable['Vat']['id'] ?>"><?php echo $vatable['Vat']['name'] . ' - ' . $vatable['Vat']['percentage'] . '%'?></option>
													<?php else : ?>
														<option selected id="<?php echo $vatable['Vat']['id'] ?>" value="<?php echo $vatable['Vat']['id'] ?>"><?php echo $vatable['Vat']['name'] . ' - 0.10 to 0.15%'?></option>
													<?php endif ?>
												<?php else : ?>
													<option id="<?php echo $vatable['Vat']['id'] ?>" value="<?php echo $vatable['Vat']['id'] ?>"><?php echo $vatable['Vat']['name'] . ' - 0.10 to 0.15%'?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
									<div id="professional-div" hidden>
										<label class="col-sm-12 col-form-label">Percentage</label>
										<div class="col-sm-12">
											<input type="number" class="form-control" id="professional-fee">
											<span class="form-text" id="professional-banner" hidden>
												<div class="bg-danger p-xs b-r-sm mt-3">Professional Fee Percentage must be between 10 to 15.</div>
											</span>
										</div>
									</div>
									<div class="col-md-12 mt-3" data-select2-id="20"><div class="ibox-content ibox-heading">
										<h4>NOTE</h4>
										<small>1. The calculation will not take effect if there is no TOTAL AMOUNT detected.</small><br>
									</div>
										<table class="table table-bordered mt-3">
											<tbody>
												<tr>
													<td>P.O.S. Trans #</td>
													<td class="text-center" id="less-vat"><?php echo !empty($vat['RcpVatable']['less_vat']) ? CakeNumber::currency($vat['RcpVatable']['less_vat']) : '---' ?></td>
													<td>Less: VAT</td>
												</tr>
												<tr>
													<td>VATable Sales</td>
													<td class="text-center" id="net-of-vat"><?php echo !empty($vat['RcpVatable']['net_vat']) ? CakeNumber::currency($vat['RcpVatable']['net_vat']) : '---' ?></td>
													<td>Net: VAT</td>
												</tr>
												<tr>
													<td>VAT-Exempt</td>
													<td class="text-center" id="vat-discount"><?php echo !empty($vat['RcpVatable']['discount']) ? CakeNumber::currency($vat['RcpVatable']['discount']) : '---' ?></td>
													<td>Less: SC/PWD Discount</td>
												</tr>
												<tr>
													<td>Zero Rated</td>
													<td class="text-center" id="vat-amount"><?php echo !empty($vat['RcpVatable']['amount_due']) ? CakeNumber::currency($vat['RcpVatable']['amount_due']) : '---' ?></td>
													<td>Amount Due</td>
												</tr>
												<tr>
													<td>VAT Amount</td>
													<td class="text-center" id="vat-total-amount"><?php echo !empty($vat['RcpVatable']['add_vat']) ? CakeNumber::currency($vat['RcpVatable']['add_vat']) : '---' ?></td>
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
								</div>
								<?php if ($rush) : ?>
								<div class="ibox-content">
									<div class="form-group" id="data_1">
										<label class="font-normal">Date</label>
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="rush_date" value="<?php echo date('m/d/yy', strtotime($rush["RcpRush"]['due_date'])) ?>" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="font-normal">Reason / Justification</label>
										<textarea class="form-control" placeholder="Your text here. . ." rows="5" id="justification"><?php echo $rush["RcpRush"]['justification'] ?></textarea>
									</div>
								</div>
								<?php else : ?>
								<div class="ibox-content">
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
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
				<div class="ibox-footer">
					<div class="text-right">
						<a href="#" class="btn btn-primary" id="update_rcp_btn" url="<?php echo $this->params->webroot . "update_rcp" ?>"><i class="fa fa-file mr-2"></i> UPDATE REQUEST FOR CHECK PAYMENT</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var rcpId = <?php echo $detail['Rcp']['id'] ?>;
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
						allowNumbers('.qty');
						allowNumbersWithDecimal('.amount');

						keypressToCalculate('.qty', checked);
						keypressToCalculate('.unit', checked);
						keypressToCalculate('.particulars', checked);
						keypressToCalculate('.ref_code', checked);
						keypressToCalculate('.code', checked);
						keypressToCalculate('.amount', checked);
					}
					else {
						return toastr.error("Rows already exceeds the limit.");
					}
				}
            }

		chosenSelect('.chosen_select');
		jsSwitch('.switcher', '#ED5565');
		rcpTable('#rcp_table', buttons);
		datePicker('#data_1 .input-group.date');

		allowNumbers('.qty');
		allowNumbersWithDecimal('.amount');

		keypressToCalculate('.qty', false);
		keypressToCalculate('.unit', false);
		keypressToCalculate('.particulars', false);
		keypressToCalculate('.ref_code', false);
		keypressToCalculate('.code', false);
		keypressToCalculate('.amount', false);

		$('#expense_type').on('change', function(event) {
			event.preventDefault();

			var checked = $(this).prop("checked");
			var url = $(this).attr("url");

			if (checked) {
				keypressToCalculate('.qty', true);
				keypressToCalculate('.unit', true);
				keypressToCalculate('.particulars', true);
				keypressToCalculate('.ref_code', true);
				keypressToCalculate('.code', true);
				keypressToCalculate('.amount', true);

				$("#rcp_table tr td, th").filter(':nth-child(5)').attr('hidden', true);
				$("#rcp_table tr td").filter(':nth-child(5)').html('');
				$('#expense_title').text("PROJECT EXPENSE");
			}
			else {
				$('#amount').text("0.00");
				$('#amount_in_words').val("");

				keypressToCalculate('.qty', false);
				keypressToCalculate('.unit', false);
				keypressToCalculate('.particulars', false);
				keypressToCalculate('.ref_code', false);
				keypressToCalculate('.code', false);
				keypressToCalculate('.amount', false);

				$('#rcp_table > thead > tr > th:nth-child(5)').removeAttr('hidden');
				$("#rcp_table td").filter(':nth-child(5)').removeAttr('hidden');
				$('#expense_title').text("DEPARTMENT EXPENSE");
			}
		})

		$(document).on('click', '.remove', function(event) {
			event.preventDefault();

			$(this).parents("tr").remove();
		})

		if (checked) {
			keypressToCalculate('.qty', true);
			keypressToCalculate('.unit', true);
			keypressToCalculate('.particulars', true);
			keypressToCalculate('.ref_code', true);
			keypressToCalculate('.code', true);
			keypressToCalculate('.amount', true);

			$("#rcp_table tr td, th").filter(':nth-child(5)').attr('hidden', true);
			$("#rcp_table tr td").filter(':nth-child(5)').html('');
			$('#expense_title').text("PROJECT EXPENSE");
		}

		$('#update_rcp_btn').on('click', function(event) {
			event.preventDefault();

			var checked = $('#expense_type').prop("checked");
			var qtyArr = [];
			var particularsArr = [];
			var unitArr = [];
			var refCodeArr = [];
			var codeArr = [];
			var amountArr = [];
			var hasEmpty = false;

			var data = new FormData();
			var url = $(this).attr('url');

			var project = $('#project').val();
			var company = $('#company').val();
			var payee = $('#payee').val().trim();

			var expenseType = $('#expense_title').text();
			var amount = $('#amount').text();
			var amountInWords = $('#amount_in_words').val();
			var dueDate = $('#rush_date').val();
			var justification = $('#justification').val().trim();

			$('#rcp_table > tbody > tr').each(function() {
				var qty = $(this).find("td").eq(0).html();
				var unit = $(this).find("td").eq(1).html();
				var particulars = $(this).find("td").eq(2).html();
				var refCode = $(this).find("td").eq(3).html();
				var code = $(this).find("td").eq(4).html();
				var amount = $(this).find("td").eq(5).html();

				if (checked) {
					if (qty && unit && particulars && refCode && !code && amount) {
						qtyArr.push(qty);
						unitArr.push(unit);
						particularsArr.push(particulars);
						refCodeArr.push(refCode);
						amountArr.push(amount);
					}
				}
				else {
					if (qty && unit && particulars && refCode && code && amount) {
						qtyArr.push(qty);
						unitArr.push(unit);
						particularsArr.push(particulars);
						refCodeArr.push(refCode);
						codeArr.push(code);
						amountArr.push(amount);
					}
				}
			});

			data.append('id', rcpId);
			data.append('project', project);
			data.append('company', company);
			data.append('payee', payee);

			data.append('expenseType', expenseType);
			data.append('amountInWords', amountInWords);
			data.append('totalAmount', amount);
			data.append('qty', qtyArr);
			data.append('unit', unitArr);
			data.append('particulars', particularsArr);
			data.append('refCode', refCodeArr);
			data.append('code', codeArr);
			data.append('amount', amountArr);
			data.append('dueDate', dueDate);
			data.append('justification', justification);

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: data,
				dataType: 'json',
				contentType: false,
				processData: false,
				success: function(response) {
					if (response.status) {
						return toastr.success(response.message, response.rcp_no)
					}
					else {
						return toastr.error(response.message, response.type)
					}
				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			})
		})

		$('#vat').on('change', function(){
			var subtotal = removeCommas($('#amount').text());
			var vatType = $(this).val();
			var professionalFee = $('#professional-fee').val();
			var vat = calculateVat(subtotal, vatType, professionalFee);

			if (subtotal == 0) {
				$(this).val(0).trigger("chosen:updated");
				return toastr.error("No total amount detected. Please specify first all the particulars to generate total amount.", "Error")
			}

			if (vatType == 4) {
				$('#professional-banner').attr('hidden', false);
			}
			else {
				$('#professional-banner').attr('hidden', true);
			}


			if (vatType == 0) {
				$('#less-vat').text('---');
				$('#net-of-vat').text('---');
				$('#vat-discount').text('---');
				$('#vat-amount').text('---');
				$('#vat-total-amount').text('---');
			}
			else {
				$('#less-vat').text(vat['lessVat']);
				$('#net-of-vat').text(vat['netVat']);
				$('#vat-discount').text(vat['discount']);
				$('#vat-amount').text(vat['vatAmount']);
				$('#vat-total-amount').text(vat['vatAmount']);
			}
		})

		$('#professional-fee').on("keypress keyup copy paste",function (event) {
			var subtotal = removeCommas($('#amount').text());
			var vatType = $('#vat').val();
			if ($(this).val() >= 10 && $(this).val() <= 15) {
				var vat = calculateVat(subtotal, vatType, $(this).val());

				$('#less-vat').text(vat['lessVat']);
				$('#net-of-vat').text(vat['netVat']);
				$('#vat-discount').text(vat['discount']);
				$('#vat-amount').text(vat['vatAmount']);
				$('#vat-total-amount').text(vat['vatAmount']);
				$('#professional-banner').attr('hidden', true);
			}
			else {
				$('#professional-banner').attr('hidden', false);
				$('#less-vat').text('---');
				$('#net-of-vat').text('---');
				$('#vat-discount').text('---');
				$('#vat-amount').text('---');
				$('#vat-total-amount').text('---');
			}
		})
	})
</script>
