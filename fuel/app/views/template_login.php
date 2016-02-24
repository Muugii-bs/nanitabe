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
</head>
<body class="hold-transition login-page">

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

	<?php echo $content; ?>

	
</body>
</html>
