<div class="register-box">
	<div class="register-box-body">
		<div class="login-logo">
			<a href="/"><b>新規登録</b></a>
		</div><!-- /.login-logo -->
		<p class="login-box-msg">必須項目を入力してください</p>
		<?php echo Form::open(array('class' => ''));?>
			<div class="form-group">
				<?php echo Form::input('username', '', array(
					'class' => 'form-control input-lg',
					'placeholder' => 'ユーザ名'));?>
			</div>
			<div class="form-group">
				<?php echo Form::input('email', '', array(
					'class' => 'form-control input-lg',
					'placeholder' => 'Email'));?>
			</div>
			<div class="form-group">
        		<?php echo Form::password('password', '', array(
					'class' => 'form-control input-lg',
					'placeholder' => 'パスワード'));?>
			</div>
			<div class="form-group">
				<?php echo Form::input('shop[name]',
					'', array(
					'class' => 'form-control input-lg',
					'placeholder' => '店舗名'));?>
			</div>
			<div class="row">
				<div class="col-xs-8">
				</div><!-- /.col -->
				<div class="col-xs-4">
					<?php echo Form::submit('submit', '新規登録', array(
						'class' => 'btn btn-primary btn-block'));?>	
				</div><!-- /.col -->
			</div>
		<?php echo Form::close();?>
	
		<a href="/admin/login">登録済みの方はこちら</a>
		
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->