<!-- .main-header -->
<header class="main-header">

	<a href="/" class="logo">なに食べ管理</a>

	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">

		<div class="collapse navbar-collapse" id="navbar-collapse">

			<!-- サイドバー制御 -->
			<a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<ul class="nav navbar-nav">
				<li><a href="/food/create"><i class="fa fa-plus"></i> 料理追加</a></li>
				<li><a href="/shop/edit"><i class="fa fa-th-list"></i> 店舗情報編集</a></li>
				<li><a href="/admin/edit"><i class="fa fa-th-list"></i> 管理者編集</a></li>
				<li><a href="/help/index"><i class="fa fa-question-circle"></i>  Help</a></li>
			</ul>

			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- Messages: style can be found in dropdown.less-->
					<li class="dropdown messages-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope-o"></i>
							<span class="label label-success">4</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 4 messages</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
									<li><!-- start message -->
										<a href="#">
											<div class="pull-left">
												<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
											</div>
											<h4>
												Sender Name
												<small><i class="fa fa-clock-o"></i> 5 mins</small>
											</h4>
											<p>Message Excerpt</p>
										</a>
									</li><!-- end message -->
									...
								</ul>
							</li>
							<li class="footer"><a href="#">See All Messages</a></li>
						</ul>
					</li>
					<!-- Notifications: style can be found in dropdown.less -->
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 10 notifications</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
									<li>
										<a href="#">
											<i class="ion ion-ios-people info"></i> Notification title
										</a>
									</li>
									...
								</ul>
							</li>
							<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
					<!-- Tasks: style can be found in dropdown.less -->
					<li class="dropdown tasks-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-flag-o"></i>
							<span class="label label-danger">9</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 9 tasks</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
									<li><!-- Task item -->
										<a href="#">
											<h3>
												Design some buttons
												<small class="pull-right">20%</small>
											</h3>
											<div class="progress xs">
												<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
													<span class="sr-only">20% Complete</span>
												</div>
											</div>
										</a>
									</li><!-- end task item -->
									...
								</ul>
							</li>
							<li class="footer">
								<a href="#">View all tasks</a>
							</li>
						</ul>
					</li>
					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo Auth::get_screen_name() . '&nbsp;さん'; ?> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<img src="/upload/img_profile.png" class="img-circle" alt="User Image">
								<p>

									<small>Member since Nov. 2012</small>
								</p>
							</li>
							<!-- Menu Body -->
							<li class="user-body">
								<div class="col-xs-4 text-center">
									<a href="#">Followers</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Friends</a>
								</div>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<?php echo Html::anchor('/admin/logout', 'ログアウト', array(
										'class' => 'btn btn-default btn-flat'
									)) ?>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<!-- /.main-header -->