<!-- .main-sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="/upload/img_profile.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo Auth::get_screen_name() . '&nbsp;さん'; ?></p>
				<a href="/"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN MENU</li>
			<li>
				<a href="/food/create"><i class="fa fa-plus"></i> 料理追加</a>
			</li>
			<li>
				<a href="/shop/edit"><i class="fa fa-th-list"></i> 店舗情報編集</a>
			</li>
			<li>
				<a href="/admin/edit"><i class="fa fa-th-list"></i> 管理者情報編集</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->