<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-6">
			<div class="ibox selected">
				<div class="ibox-content">
					<div class="tab-content">
						<div id="contact-1" class="tab-pane active">
							<div class="row m-b-lg text-center">
								<div class="col-lg-12">
									<h2><?php echo $profile['User']['firstname'] . " " . $profile['User']['lastname']?></h2>
										<div class="m-b-sm">
											<img alt="image" src="<?php echo $this->params->webroot . "img/default.png" ?>">
										</div>
										</div>
									</div>
									<di>
										<div>
										<div >
										<strong>Personal Information</strong>
										<ul class="list-group clear-list">
											<li class="list-group-item fist-item">
												<span class="float-right"> Firstname </span>
												<?php echo $profile['User']['firstname'] ?>
											</li>
											<li class="list-group-item">
												<span class="float-right"> Lastname </span>
												<?php echo $profile['User']['lastname'] ?>
											</li>
											<li class="list-group-item">
												<span class="float-right"> Middle Initial </span>
												Open new shop
											</li>
										</ul>
									</div>
									<a href="#" class="btn btn-primary btn-sm btn-block">Update Information</a>
								</div>
							</di>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="ibox selected">
				<div class="ibox-content">
					<div class="tab-content">
						<div id="contact-1" class="tab-pane active">
							<div class="row m-b-lg">
								<div class="col-lg-12">
									<div class="">
										<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="full-height-scroll" style="overflow: hidden; width: auto; height: 100%;">
										<strong>ACCOUNT INFORMATION</strong>
											<ul class="list-group clear-list">
												<li class="list-group-item fist-item">
													<span class="float-right">Username</span>
													<?php echo $profile['UserAccount']['username'] ?>
												</li>
												<li class="list-group-item">
													<span class="float-right">Email Address</span>
													<?php echo $profile['UserAccount']['email'] ?>
												</li>
											</ul>
										<hr>
										<div class="ibox-content ibox-heading">
											<strong>NOTE</strong><br>
											<small>1. If you have issues or problem while using the system, please contact the System Administrator.</small><br>
											<small>2. Only the System Administrator can update your company, department and project details.</small><br>
										</div>
										<hr>
										<strong>ORGANIZATIONS</strong>
										<div id="vertical-timeline" class="vertical-container dark-timeline">
											<div class="vertical-timeline-block">
												<div class="vertical-timeline-icon gray-bg">
													<i class="fa fa-building"></i>
												</div>
												<div class="vertical-timeline-content">
													<p><?php echo $profile['Company']['name'] ?></p>
													<span class="vertical-date small text-muted">Company</span>
												</div>
											</div>
													<div class="vertical-timeline-block">
														<div class="vertical-timeline-icon gray-bg">
															<i class="fa fa-home"></i>
														</div>
														<div class="vertical-timeline-content">
															<p><?php echo $profile['Department']['name'] ?></p>
															<span class="vertical-date small text-muted">Department</span>
														</div>
													</div>
													<div class="vertical-timeline-block">
														<div class="vertical-timeline-icon gray-bg">
															<i class="fa fa-tasks"></i>
														</div>
														<div class="vertical-timeline-content">
															<p><?php echo $profile['Project']['name'] ?></p>
															<span class="vertical-date small text-muted">Project</span>
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
		</div>
	</div>
</div>
