<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu" style="">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<img width="50" alt="image" class="rounded-circle" src="<?php echo $this->params->base . '/img/person-circle.png' ?>">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="block m-t-xs font-bold"><?php echo $name ?></span>
						<span class="text-muted text-xs block">Requestor</span>
					</a>
				</div>
				<div class="logo-element">
					RCP
				</div>
			</li>
			<li class="special_link">
				<a href="<?php echo $this->params->webroot . 'create'?>"><i class="fa fa-file-text"></i> <span class="nav-label">Create RCP</span></a>
			</li>
			<li class="<?php if ($this->params->controller == "dashboard") echo "active" ?>">
				<a href="<?php echo $this->params->webroot . 'dashboard'?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
			</li>
			<li class="<?php if ($this->params->controller == "rcp") echo "active" ?>">
				<a href="<?php echo $this->params->webroot . 'rcps'?>"><i class="fa fa-copy"></i> <span class="nav-label">RCP</span></a>
			</li>
			<li class="<?php if ($this->params->controller == "users") echo "active" ?>">
				<a href="<?php echo $this->params->webroot . 'profile' ?>"><i class="fa fa-vcard"></i> <span class="nav-label">Profile</span></a>
			</li>
		</ul>
    </div>
</nav>
