<div id="page-wrapper" class="gray-bg">
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12 animated">
				<div class="mail-box-header" style='background-color: orange; padding: 5px; color: white'>
					<h2>
						Request for Check Payment Approval
					</h2>
				</div>
				<div class="mail-box">
					<div class="mail-body">
						<p>
							Hello, <?php echo $app_name ?>!
							<br>
							<br>
							You have received a Request for Check Payment for approval with an RCP No. of <strong><?php echo $rcp_no ?></strong> from <?php echo $requestor ?> that issued on <?php echo $date ?>.
							<br>You can check more information by clicking this <a href="<?php echo $link ?>">link</a>.
							<br><br>
							Payee: <?php echo $payee ?><br>
							Department: <?php echo $department ?><br>
							Company: <?php echo $company ?><br>
							Project: <?php echo $project ?><br>
						</p>
						<?php if ($justification) : ?>
							<p>
								Due Date: <?php echo $due_date ?><br>
								Justification: <?php echo $justification ?><br>
							</p>
						<?php endif ?>
					</div>
					<div class="mail-footer">
						<p>
							Best Regards,
							<br>
							<strong>System Administrator</strong>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
