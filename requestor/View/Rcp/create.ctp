<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Request for Check Payment Form</h5>
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
								<div class="alert alert-info">
									Please select a department to validate if the approvers were all set.
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">
									<div class="col-md-3" data-select2-id="10">
										<h5>Department</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true" url="<?php echo $this->params->webroot . "approvers" ?>">
											<option value="0">Select Department</option>
											<?php foreach ($departments as $department) : ?>
												<option value="<?php echo $department['Department']['id'] ?>" data-select2-id="21"><?php echo $department['Department']['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="col-md-4" data-select2-id="10">
										<h5>Company</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="company" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option value="0">Select Company</option>
											<?php foreach ($companies as $company) : ?>
												<option value="<?php echo $company['Company']['id'] ?>" data-select2-id="21"><?php echo $company['Company']['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-3" data-select2-id="20">
										<h5>Project</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="project" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option value="0">Select Project</option>
											<?php foreach ($projects as $project) : ?>
												<option value="<?php echo $project['Project']['id'] ?>" data-select2-id="21"><?php echo $project['Project']['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-2" data-select2-id="20">

									<h5 id="expense_title">DEPARTMENT EXPENSE</h5>
										<div>
											<span >
												<input type="checkbox" class="expense_type switcher" data-switchery="true" style="display: none;" id="expense_type"">
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
										<input type="email" placeholder="Payee" id="payee" class="form-control">
									</div>
									<div class="col-md-8" data-select2-id="20">
										<h5>Amount in Words</h5>
										<input type="text" placeholder="NO TOTAL AMOUNT DETECTED" disabled class="form-control text-center" id="amount_in_words">
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
													<th width="10%">Code</th>
													<th>Amount</th>
													<th width="4%"></th>
												</tr>
											</thead>
											<tbody>
												<?php for ($i = 0; $i < 5; $i++) : ?>
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
											</tbody>
										</table>
									</div>
									<div class="col-md-12 text-right" data-select2-id="20">
										<div>
											<span class="text-right">
											<h1 class="m-b-xs" id="amount">0.00</h1>
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
									<h5>Fill up the following if this RCP is VATABLE</h5>
								</div>
								<div class="ibox-content">
									<div class="col-md-12" data-select2-id="20">
										<select class="form-control select2-hidden-accessible chosen_select" id="vat" data-select2-id="6" tabindex="-1" aria-hidden="true">
												<option value="0">Select option if vatable</option>
											<?php foreach ($vats as $vat) : ?>
												<?php if ($vat['Vat']['id'] != 4) : ?>
													<option id="<?php echo $vat['Vat']['id'] ?>" value="<?php echo $vat['Vat']['id'] ?>"><?php echo $vat['Vat']['name'] . ' - ' . $vat['Vat']['percentage'] . '%'?></option>
												<?php else : ?>
													<option id="<?php echo $vat['Vat']['id'] ?>" value="<?php echo $vat['Vat']['id'] ?>"><?php echo $vat['Vat']['name'] . ' - 0.10 to 0.15%'?></option>
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
													<td class="text-center" id="less-vat">---</td>
													<td>Less: VAT</td>
												</tr>
												<tr>
													<td>VATable Sales</td>
													<td class="text-center" id="net-of-vat">---</td>
													<td>Net: VAT</td>
												</tr>
												<tr>
													<td>VAT-Exempt</td>
													<td class="text-center" id="vat-discount">---</td>
													<td>Less: SC/PWD Discount</td>
												</tr>
												<tr>
													<td>Zero Rated</td>
													<td class="text-center" id="vat-amount">---</td>
													<td>Amount Due</td>
												</tr>
												<tr>
													<td>VAT Amount</td>
													<td class="text-center" id="vat-total-amount">---</td>
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
								<div class="ibox-content">
									<div class="form-group" id="data_1">
										<label class="font-normal">Date</label>
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="rush_date" readonly class="form-control">
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
				<div class="ibox-footer">
					<div class="text-right">
						<a href="<?php echo $this->params->webroot . "send_rcp" ?>" class="btn btn-primary" id="send_rcp_btn"><i class="fa fa-send mr-2"></i> SEND REQUEST FOR CHECK PAYMENT</a>
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

			$("#department").val(0).trigger("chosen:updated");
		})

		$(document).on('click', '.remove', function(event) {
			event.preventDefault();

			$(this).parents("tr").remove();
		})

		$('#send_rcp_btn').on('click', function(event) {
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
			var url = $(this).attr('href');
			var department = $('#department').val();
			var approver = $('#approver').val();
			var project = $('#project').val();
			var expenseType = $('#expense_title').text();
			var company = $('#company').val();
			var payee = $('#payee').val().trim();
			var amount = $('#amount').text();
			var amountInWords = $('#amount_in_words').val();
			var dueDate = $('#rush_date').val();
			var justification = $('#justification').val().trim();
			var vatType = $('#vat').val();

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

			data.append('department', department);
			data.append('project', project);
			data.append('expenseType', expenseType);
			data.append('company', company);
			data.append('payee', payee);
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

			if (vatType > 0) {
				var professionalFee = $('#professional-fee').val();
				var vat = calculateVat(removeCommas(amount), vatType, professionalFee);

				data.append('isVatable', true);
				data.append('vatType', vatType);
				data.append('lessVat', vat['lessVat']);
				data.append('netVat', vat['netVat']);
				data.append('discount', vat['discount']);
				data.append('vatAmount', vat['vatAmount']);
				data.append('addVat', vat['vatAmount']);
			}
			else {
				data.append('isVatable', false);
			}

			$.LoadingOverlay("show");

			var request = $.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: data,
				dataType: 'json',
				contentType: false,
				processData: false,
				success: function(response) {
					if (response.status) {
						$("#department").val(0).trigger("chosen:updated");
						$("#company").val(0).trigger("chosen:updated");
						$("#project").val(0).trigger("chosen:updated");
						$('#expense_type').prop("checked", false)
						$.LoadingOverlay("hide");

						return toastr.success(response.message, response.rcp_no)
					}
					else {
						$.LoadingOverlay("hide");
						return toastr.error(response.message, response.type)
					}
				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			})
		})

		$('#department').on('change', function(){
			var id = $(this).val();
			var url = $(this).attr('url');
			var expenseType = $('#expense_title').text();

			var request = $.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					id: id,
					expenseType: expenseType
				},
				dataType: 'json',
				success: function(response) {
					if (response.status) {
						$('#page-wrapper > div.wrapper.wrapper-content.animated > div > div > div > div.ibox-footer').attr('hidden', false);
						return toastr.success(response.message, response.type)
					}
					else {
						$('#page-wrapper > div.wrapper.wrapper-content.animated > div > div > div > div.ibox-footer').attr('hidden', true);
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
		});
	})
</script>
