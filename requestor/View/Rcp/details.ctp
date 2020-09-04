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
											<?php if (count($particulars) < 5) : ?>
												<?php for ($i = count($particulars); $i < 5; $i++) : ?>
													<tr class="text-center">
														<td>---</td>
														<td>---</td>
														<td>---</td>
														<td>---</td>
														<?php if ($detail['Rcp']['expense_type'] == "DEPARTMENT EXPENSE") : ?>
															<td>---</td>
														<?php endif ?>
														<td>---</td>
													</tr>
												<?php endfor ?>
											<?php endif ?>
											</tbody>
										</table>
									</div>
									<div class="col-md-12 text-right" data-select2-id="20">
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
					<div class="row">
						<div class="col-lg-8">
							<div class="ibox ">
								<div class="ibox-title">
									<h5>Fill up the following if this RCP is VATABLE</h5>
								</div>
								<div class="ibox-content">
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
										<table class="table table-bordered mt-3">
											<tbody>
												<tr>
													<td>P.O.S. Trans #</td>
													<td class="text-center">---</td>
													<td>Less: VAT</td>
												</tr>
												<tr>
													<td>VATable Sales</td>
													<td class="text-center">---</td>
													<td>Net: VAT</td>
												</tr>
												<tr>
													<td>VAT-Exempt</td>
													<td class="text-center">---</td>
													<td>Less: SC/PWD Discount</td>
												</tr>
												<tr>
													<td>Zero Rated</td>
													<td class="text-center">---</td>
													<td>Amount Due</td>
												</tr>
												<tr>
													<td>VAT Amount</td>
													<td class="text-center">---</td>
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
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="rush_date" class="form-control" disabled value="<?php echo $rush['due_date'] ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="font-normal">Reason / Justification</label>
										<textarea class="form-control" placeholder="Your text here. . ." rows="5" id="justification" disabled><?php echo $rush['justification'] ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ibox-footer">
					<div class="text-right">
						<a href="<?php echo $this->params->webroot . 'edit/' . $detail['Rcp']['id'] ?>" class="btn btn-primary"><i class="fa fa-file mr-2"></i> Edit Details</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// initializations
		chosenSelect('.chosen_select');
		jsSwitch('.switcher', '#ED5565');
		rcpTable('#rcp_table', []);
	});
</script>
