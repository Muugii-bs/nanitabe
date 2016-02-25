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
			</ul>

			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

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