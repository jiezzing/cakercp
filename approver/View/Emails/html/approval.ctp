<div id="page-wrapper" class="gray-bg">
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12 animated">
				<div class="mail-box-header" style='background-color: orange; padding: 5px; color: white'>
					<h2>
						Request for Check Payment Approval [<?php echo $progress ?>]
					</h2>
				</div>
				<div class="mail-box">
					<div class="mail-body">
						<p>
							Hello, <?php echo $recepient ?>!
							<br>
							<br>
							You have received a Request for Check Payment that is for <i>APPROVAL</i> with an RCP No. of <strong><?php echo $details['Rcp']['rcp_no'] ?></strong> from <?php echo $requestor ?> that issued on <?php echo CakeTime::nice($details['Rcp']['created']) ?>.
							<br>You can check more information by using the Online RCP System.
							<br><br>
							Payee: <?php echo $details['Rcp']['payee'] ?><br>
							Department: <?php echo $details['Department']['name'] ?><br>
							Company: <?php echo $details['Company']['name'] ?><br>
							Project: <?php echo $details['Project']['name'] ?><br>
						</p>
						<?php if (!empty($rush['RcpRush']['justification'])) : ?>
							<p>
								Due Date: <?php echo $rush['RcpRush']['due_date'] ?><br>
								Justification: <?php echo $rush['RcpRush']['justification'] ?><br>
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
