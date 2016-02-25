<div class="box box-info">
	<div class="shopForm">
		<?php echo Form::open(array("class"=>"form-horizontal")); ?>
			<!-- .box-body -->
			<div class="box-body">
				<div class="form-group">
					<?php //echo Form::hidden('shop_id', $current_admin['shop_id'], array()); ?>	
				</div>
				<div class="form-group">
					<?php echo Form::label('料理名', 'name', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('name', Input::post('name', isset($shop) ? $shop->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'店舗名')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('郵便番号', 'zip', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('zip', Input::post('zip', isset($shop) ? $shop->zip : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'郵便番号')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('住所', 'address', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('address', Input::post('address', isset($shop) ? $shop->address : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'住所')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('経度', 'longti', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('longti', Input::post('longti', isset($shop) ? $shop->longti : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'経度')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('緯度', 'lati', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('lati', Input::post('longti', isset($shop) ? $shop->lati : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'緯度')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('URL', 'url', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('url', Input::post('url', isset($shop) ? $shop->url : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'URL')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('TEL', 'tel', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('tel', Input::post('tel', isset($shop) ? $shop->tel : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'TEL')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('店舗画像', 'image_1', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
							<?php echo Form::input('image_1', Input::post('image_1', isset($shop) ? $shop->image_1 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=> '店舗画像')); ?>
							<div id="image_1_upload"><i class="fa fa-upload"></i> アップロード</div>
							<div id="image_1_thumbnail" class="thumbnail-up"<?php if(isset($shop)) echo Input::post('image_1', strlen($shop->image_1) > 5  ? ' style="display: block;"' : ''); ?>>
							<?php if(isset($shop)) echo Input::post('image_1', strlen($shop->image_1) > 5 ? '<img src="' . $shop->image_1 . '" alt="' . $shop->image_1 . '" />' : '<img src="" alt="image_1" />'); else echo '<img src="" alt="image_1" />'; ?>
							<a class="delete_img btn btn-default btn-xs" data-id="#form_image_1" href="javascript:void(0);" onclick="return confirm('削除します。よろしいですか？')"<?php if(isset($shop)) echo Input::post('image_1', strlen($shop->image_1) > 5  ? ' style="display: inline;"' : ''); ?>><i class="fa fa-trash-o"></i> 削除</a>
							</div>
						</div>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<?php echo Html::anchor('home', '<i class="fa fa-chevron-left"></i> 戻る', array(
					'class' => 'btn btn-default'
				)); ?>
				<?php echo Form::submit('submit', '送信', array('class' => 'btn btn-primary pull-right')); ?>
			</div>
			<!-- /.box-footer -->
		<?php echo Form::close(); ?>
	</div>
</div>