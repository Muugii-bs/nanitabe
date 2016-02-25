<!-- .main -->
<div class="main">
	<?php if (!empty($foods)): ?>
		<?php echo View::forge('food/_list', array(
			'foods' => $foods
		)); ?>
	<?php else: ?>
	<div class="">
		料理を追加してください
	</div>
	<?php endif; ?>
</div>
<!-- .main -->