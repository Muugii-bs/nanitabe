<div class="login-box">
	<div class="login-box-body">
		<div class="login-logo">
			<a href="/"><b>なに食べ 管理</b></a>
		</div><!-- /.login-logo -->
		<p class="login-box-msg">ユーザ名とパスワードを入力してください。</p>
		<?php echo Form::open(array('class' => ''));?>
			<div class="form-group">
				<?php echo Form::input('username', '', array(
					'class' => 'form-control input-lg',
					'placeholder' => 'ユーザ名'));?>
			</div>
			<div class="form-group">
        		<?php echo Form::password('password', '', array(
					'class' => 'form-control input-lg',
					'placeholder' => 'パスワード'));?>
			</div>
			<div class="row">
				<div class="col-xs-8">
				</div><!-- /.col -->
				<div class="col-xs-4">
					<?php echo Form::submit('submit', 'ログイン', array(
						'class' => 'btn btn-primary btn-block'));?>	
				</div><!-- /.col -->
			</div>
		<?php echo Form::close();?>
	
		<a href="/admin/create">新規登録はこちら</a>
		
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->