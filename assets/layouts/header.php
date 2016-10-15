<header>
	<nav class="navbar navbar-default navbar-transparent">
		<div class="container" id="nav-container">
			<div class="navbar-header">
				<button class="navbar-toggle navbar-toggle-settings" data-target="#top-navbar" data-toggle="collapse" type="button">
					<span class="sr-only">Toggle navigation</span>
					<i class="ion ion-ios7-gear-outline"></i>
				</button>
				<a class="navbar-brand logo" href="#">
					<img src="<?php echo base_url(); ?>/assets/images/logo.png" alt="App logo" width="175">
				</a>
				<div class="navbar-side-menu-toggle">
					<button class="toggle-btn" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
			</div>
			<div class="collapse navbar-collapse" id="top-navbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="page_home.html">Home</a></li>
					<li><a href="app_support.html" target="_blank"><i class="fa fa-support"></i> <span class="notification-title">Support</span></a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-bell"></i> <span class="notification-title">Notifications</span><span class="badge badge-danger notification-badge">6</span></a>
						<div class="dropdown-menu notification-menu">
							<div class="panel panel-plain m-bot0">
								<div class="list-group">
									<a href="page_notifications.html" class="list-group-item">
										<i class="fa fa-ban text-danger"></i> Nikita Williams rejected an Action Step from you
									</a>
									<a href="page_notifications.html" class="list-group-item">
										<i class="fa fa-check-circle text-success"></i> You accepted an Action Step from Scott Marshall
									</a>
								</div>
								<div class="panel-footer p-0">
									<a href="page_notifications.html" class="btn btn-link btn-block m-bot0">View all</a>
								</div>
							</div>
						</div>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo base_url(); ?>/assets/images/21.jpg" alt="Pic" class="user-settings-pic"> Regina Hanson <i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu">
							<li><a href="app_tour.html">App Tour</a></li>
							<li><a href="app_profile.html">My Profile</a></li>
							<li><a href="app_settings.html">Account Settings</a></li>
							<li class="divider"></li>
							<li><a href="app_login.html">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>