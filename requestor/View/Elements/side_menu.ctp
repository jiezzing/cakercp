<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu" style="">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<img alt="image" class="rounded-circle" src="img/profile_small.jpg">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="block m-t-xs font-bold">David Williams</span>
						<span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
					</a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
						<li><a class="dropdown-item" href="profile.html">Profile</a></li>
						<li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
						<li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
						<li class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="login.html">Logout</a></li>
					</ul>
				</div>
				<div class="logo-element">
					IN+
				</div>
			</li>
			<li>
				<a href="<?php echo $this->params->base . '/dashboard'?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
			</li>
			<li>
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Check Payments </span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse" aria-expanded="false">
					<li><a href="form_basic.html">Pending</a></li>
					<li><a href="form_advanced.html">Approved</a></li>
					<li><a href="form_wizard.html">Declined</a></li>
				</ul>
			</li>
			<li>
				<a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Report Generation</span></a>
			</li>
			<li>
				<a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Profile</span></a>
			</li>
			<li class="special_link">
				<a href="<?php echo $this->params->base . '/create'?>"><i class="fa fa-database"></i> <span class="nav-label">Create RCP</span></a>
			</li>
		</ul>
    </div>
</nav>
