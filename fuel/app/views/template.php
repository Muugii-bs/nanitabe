<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('uploadfile.min.css'); ?>
	<?php echo Asset::css('font-awesome.min.css'); ?>
	<?php echo Asset::css('bootstrap.min.css'); ?>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" >
	<!-- ionicons -->
	<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- adminLTE style -->
	<?php echo Asset::css('css/AdminLTE.min.css'); ?>
	<?php echo Asset::css('css/skins/skin-blue.min.css'); ?>
	<?php echo Asset::css('default.css'); ?>
	
	<?php echo Asset::js('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'); ?>
	<?php echo Asset::js('jquery.uploadfile.min.js'); ?>
	<?php echo Asset::js('bootstrap.min.js'); ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
	<!-- adminLTE -->
	<?php echo Asset::js('js/app.min.js'); ?>
	<?php echo Asset::js('js/jquery.slimscroll.min.js'); ?>
	<?php echo Asset::js('default.js'); ?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;region=JP"></script>
</head>

<body class="skin-blue fixed">
	<!-- .wrapper -->
	<div class="wrapper">

		<?php echo View::forge('header', array()); ?>
		
		<?php echo View::forge('sidebar/main', array()); ?>
		
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			
			<!-- .content-alert -->
			<div class="content-alert row">
				<div class="col-md-12">
					<?php if (Session::get_flash('success')): ?>
						<div class="alert alert-success">
							<strong>Success</strong>
							<p>
								<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
							</p>
						</div>
					<?php endif; ?>
					<?php if (Session::get_flash('error')): ?>
						<div class="alert alert-danger">
							<strong>Error</strong>
							<p>
								<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
							</p>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- /.content-alert -->

			<!-- .content-header -->
			<section class="content-header">
				<h1>
					<?php echo $title; ?>
					<small><?php echo $subtitle; ?></small>
				</h1>
				<?php echo Util_Common::bread_crumbs(); ?>
			</section>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">

				<?php echo $content; ?>

			</section><!-- /.content -->
		</div><!-- /.content-wrapper -->

		<!-- フッター -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">Version1.0</div>
			<strong>Copyright &copy; 2015</strong>, All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
			</div>
		</aside><!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
			 immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- /.wrapper -->
</body>
</html>
