<div id="page-wrapper" class="gray-bg">
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12 animated">
				<div class="mail-box-header" style='background-color: orange; padding: 5px; color: white'>
					<h2>
						Request for Check Payment Feedback
					</h2>
				</div>
				<div class="mail-box">
					<div class="mail-body">
						<p>
							Hello, <?php echo $requestor ?>!
							<br>
							<br>
							Your RCP No. <strong><?php echo $rcp_no ?></strong> received a feedback from the approver.
							<br><br>
							Feedback Content: <?php echo $feedback ?><br>
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
