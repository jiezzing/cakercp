<div id="page-wrapper" class="gray-bg">
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12 animated">
				<div class="mail-box-header" style='background-color: <?php echo $color ?>; padding: 5px; color: white'>
					<h2>
					<?php echo $title ?>
					</h2>
				</div>
				<div class="mail-box">
					<div class="mail-body">
						<p>
							Hello, <?php echo $requestor ?>!
							<br>
							<br>
							<?php if ($color == "orange") : ?>
								Your RCP No. <strong><?php echo $rcp_no ?></strong> received a feedback from the approver. Please assist this concern to proceed the process.
							<?php elseif ($color == "red") : ?>
								Your RCP No. <strong><?php echo $rcp_no ?></strong> has been declined by the approver.
							<?php else : ?>
								Your RCP No. <strong><?php echo $rcp_no ?></strong> is now in process and is now forwarded to the other approver. <br>This process may take a while depending to the approvers response.
							<?php endif ?>
							<?php if ($color != "green") : ?>
							<br><br>
							<strong>Reason / Justification:</strong><br>
							<?php echo $feedback ?><br>
							<?php endif ?>
						</p>
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
