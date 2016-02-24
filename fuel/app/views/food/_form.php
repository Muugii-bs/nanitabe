<div class="box box-info">
	<div class="foodForm">
		<?php echo Form::open(array("class"=>"form-horizontal")); ?>
			<!-- .box-body -->
			<div class="box-body">
				<div class="form-group">
					<?php echo Form::hidden('shop_id', $current_admin['shop_id'], array()); ?>	
				</div>
				<div class="form-group">
					<?php echo Form::label('料理名', 'name', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('name', Input::post('name', isset($food) ? $food->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'商品名')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('値段', 'price', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('price', Input::post('cost', isset($food) ? $food->price : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'値段')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('料理画像1', 'image_1', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
							<?php echo Form::input('image_1', Input::post('image_1', isset($product) ? $product->image_1 : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'商品画像1')); ?>
							<div id="image_1_upload"><i class="fa fa-upload"></i> アップロード</div>
							<div id="image_1_thumbnail" class="thumbnail-up"<?php if(isset($product)) echo Input::post('image_1', strlen($product->image_1) > 5  ? ' style="display: block;"' : ''); ?>>
							<?php if(isset($product)) echo Input::post('image_1', strlen($product->image_1) > 5 ? '<img src="/upload/' . $product->image_1 . '" alt="' . $product->image_1 . '" />' : '<img src="" alt="image_1" />'); else echo '<img src="" alt="image_1" />'; ?>
							<a class="delete_img btn btn-default btn-xs" data-id="#form_image_1" href="javascript:void(0);" onclick="return confirm('削除します。よろしいですか？')"<?php if(isset($product)) echo Input::post('image_1', strlen($product->image_1) > 5  ? ' style="display: inline;"' : ''); ?>><i class="fa fa-trash-o"></i> 削除</a>
							</div>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('大カテゴリ', 'cat1', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::select('cat1', Input::post('cat1', isset($food) ? $food->cat1 : 0), Util_Common::food_cat1(), array('class' => 'col-md-4 form-control', 'placeholder'=>'大カテゴリ')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('中カテゴリ', 'cat2', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::select('cat2', Input::post('cat2', isset($food) ? $food->cat2 : 0), Util_Common::food_cat2(), array('class' => 'col-md-4 form-control', 'placeholder'=>'大カテゴリ')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('小カテゴリ', 'cat3', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::select('cat3', Input::post('cat3', isset($food) ? $food->cat3 : 0), Util_Common::food_cat3(), array('class' => 'col-md-4 form-control', 'placeholder'=>'小カテゴリ')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('タグ1', 'tag1', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('tag1', Input::post('cost', isset($food) ? $food->tag1 : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'タグ1')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('タグ2', 'tag2', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('tag2', Input::post('cost', isset($food) ? $food->tag2 : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'タグ2')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('タグ3', 'tag3', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('tag3', Input::post('cost', isset($food) ? $food->tag3 : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'タグ3')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('タグ4', 'tag4', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('tag4', Input::post('cost', isset($food) ? $food->tag4 : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'タグ4')); ?>
						</div>
				</div>
				<div class="form-group">
					<?php echo Form::label('タグ5', 'tag5', array('class'=>'col-sm-2 control-label')); ?>
						<div class="col-sm-9">
						<?php echo Form::input('tag5', Input::post('cost', isset($food) ? $food->tag5 : ''), array('class' => 'col-md-4 form-control min', 'placeholder'=>'タグ5')); ?>
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