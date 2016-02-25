<!-- .foodList -->
<div class="foodList">
	<div class="row thumbnails">
		<?php $cnt = 1; ?>
		<?php foreach($foods as $food): ?>
			<div class="col-sm-6 col-xs-12">
			<?php echo View::forge('food/_thumbnail', array(
				'food' => $food
			)); ?>
			</div>
			<?php if ($cnt % 2 == 0): ?>
				<?php echo '<div class="clearfix"></div>'; ?>
			<?php endif; ?>
			<?php $cnt++; ?>
		<?php endforeach; ?>
	</div>
</div>
<!-- /.foodList -->