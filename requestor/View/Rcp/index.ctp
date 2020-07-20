<div class="wrapper wrapper-content animated">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="row">
					<div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link active" data-toggle="tab" href="#tab-0">All RCP</a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab-1"><span class="label label-warning">Pending</span></a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab-2"><span class="label label-success">Approved</span></a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab-3"><span class="label label-danger">Declined</span></a></li>
							</ul>
							<div class="tab-content">
								<?php echo $this->element('all_rcp_tab', $rcps) ?>
								<?php echo $this->element('rcp_tab1', $rcps) ?>
								<?php echo $this->element('rcp_tab2', $rcps) ?>
								<?php echo $this->element('rcp_tab3', $rcps) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		dataTable('.table');
		iChecks('.i-checks');
	})
</script>


