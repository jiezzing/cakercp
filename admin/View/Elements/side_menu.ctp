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
			<li class="<?php echo $this->params->controller == 'dashboard' ? "active" : "" ?>">
				<a href="<?php echo $this->params->base . '/dashboard'?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
			</li>
			<li class="<?php echo $this->params->controller == 'rcp' ? "active" : "" ?>">
				<a href="<?php echo $this->params->base . '/rcp'?>"><i class="fa fa-file"></i> <span class="nav-label">RCP</span></a>
			</li>
			<li class="<?php echo $this->params->controller == 'approvers' ? "active" : "" ?>">
				<a href="<?php echo $this->params->base . '/approvers'?>"><i class="fa fa-th-large"></i> <span class="nav-label">Approver</span></a>
			</li>
			<li class="<?php echo $this->params->controller == 'departments' || $this->params->controller == 'companies' || $this->params->controller == 'projects' ? "active" : "" ?>">
				<a href="#"><i class="fa fa-home fa-lg"></i><span class="nav-label">Organizations </span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse" aria-expanded="false">
					<li class="<?php echo $this->params->controller == 'departments' ? "active" : "" ?>"><a href="<?php echo $this->params->base . '/departments' ?>">Departments</a></li>
					<li class="<?php echo $this->params->controller == 'companies' ? "active" : "" ?>"><a href="<?php echo $this->params->base . '/companies' ?>">Companies</a></li>
					<li class="<?php echo $this->params->controller == 'projects' ? "active" : "" ?>"><a href="<?php echo $this->params->base . '/projects' ?>">Projects</a></li>
				</ul>
			</li>
			<li class="<?php echo $this->params->controller == 'users' ? "active" : "" ?>">
				<a href="<?php echo $this->params->base . '/users'?>"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
			</li>
		</ul>
    </div>
</nav>
