<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5>Request for Check Payment Fill-up Form</h5>
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
                		<div class="col-lg-12">
							<div class="ibox">
								<div class="row" data-select2-id="11">
									<div class="col-md-4" data-select2-id="10">
										<h5>Department</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="department" data-select2-id="6" tabindex="-1" aria-hidden="true" url="<?php echo $this->params->base . "/dept_approvers" ?>">
											<option data-select2-id="8">Select Department</option>
											<?php foreach ($departments as $department) : ?>
												<option value="<?php echo $department['Department']['id'] ?>" data-select2-id="21"><?php echo $department['Department']['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="col-md-3" data-select2-id="20">
										<h5>Approver</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="approver" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option data-select2-id="8">Select Department First</option>
										</select>
									</div>
									<div class="col-md-3" data-select2-id="20">
										<h5>Project</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="project" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option data-select2-id="8">Select Project</option>
											<?php foreach ($projects as $project) : ?>
												<option value="<?php echo $project['Project']['id'] ?>" data-select2-id="21"><?php echo $project['Project']['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-2" data-select2-id="20">

									<h5 id="expense_title">PROJECT EXPENSE</h5>
										<div>
											<span >
												<input type="checkbox" class="expense_type switcher" checked="" data-switchery="true" style="display: none;" id="expense_type" url="<?php echo $this->params->base . '/expense_type' ?>">
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
									<div class="col-md-4" data-select2-id="10">
										<h5>Company</h5>
										<select class="form-control select2-hidden-accessible chosen_select" id="company" data-select2-id="6" tabindex="-1" aria-hidden="true">
											<option data-select2-id="8">Select Company</option>
											<?php foreach ($companies as $company) : ?>
												<option value="<?php echo $company['Company']['id'] ?>" data-select2-id="21"><?php echo $company['Company']['name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="col-md-8" data-select2-id="20">
										<h5>Payee</h5>
										<input type="email" placeholder="Enter email" id="exampleInputEmail2" class="form-control">
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
										<input type="email" placeholder="NO TOTAL AMOUNT DETECTED" id="exampleInputEmail2" disabled class="form-control text-center">
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
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
												<?php for ($i = 0; $i < 5; $i++) : ?>
													<tr>
														<td contenteditable="true"></td>
														<td contenteditable="true"></td>
														<td contenteditable="true"></td>
														<td contenteditable="true"></td>
														<td contenteditable="true"></td>
													</tr>
												<?php endfor ?>
											</tbody>
										</table>
									</div>

									<div class="col-md-12" data-select2-id="20">
										<div>
											<span class="float-right text-right">
											<h1 class="m-b-xs ">₱ 50,992</h1>
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
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
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
		var buttons = {
                text: 'Add New Row',
                action: function (e, dt, node, config) {
                    alert( 'Button activated' );
				}
            }

		// initializations
		chosenSelect('.chosen_select');
		jsSwitch('.switcher', '#ED5565');
		dataTable('#rcp_table', buttons);
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
					$.each(response, function(index, value) {
						$('#approver').append(`<option value="${value.id}">${value.approver}</option>`).trigger("chosen:updated");
					})

				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			}).done(function() {
				$('#approver').children().remove();
			})
		})

		$('#expense_type').on('change', function(event) {
			event.preventDefault();

			var checked = $(this).prop("checked");
			var url = $(this).attr("url");

			$.ajax({
				type: 'POST',
				url: url,
				cache: false,
				data: {
					checked: checked
				},
				dataType: 'json',
				success: function(response) {
					$('#expense_title').text(response.message);
				},
				error: function (response, desc, exception) {
					alert(exception);
				}
			})
		})
	});
</script>
