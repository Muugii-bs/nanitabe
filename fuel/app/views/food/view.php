<p>
	<strong>id:</strong>
	<?php echo $food->id; ?></p>
<p>
	<strong>name:</strong>
	<?php echo $food->name; ?></p>
<p>
	<strong>Shop_id</strong>
	<?php echo $food->shop_id; ?></p>
<p>
	<strong>Url:</strong>
	<?php echo $food->image_1; ?></p>
<p>
	<strong>Category 1:</strong>
	<?php echo $food->cat1; ?></p>
<p>
	<strong>Category 2:</strong>
	<?php echo $food->cat2; ?></p>
<p>
	<strong>Category 3:</strong>
	<?php echo $food->cat3; ?></p>
<p>
	<strong>Tag 1:</strong>
	<?php echo $food->tag1; ?></p>
<p>
	<strong>Tag 2:</strong>
	<?php echo $food->tag2; ?></p>
<p>
	<strong>Tag 3:</strong>
	<?php echo $food->tag3; ?></p>
<p>
	<strong>Tag 4:</strong>
	<?php echo $food->tag4; ?></p>
<p>
	<strong>Tag 5:</strong>
	<?php echo $food->tag5; ?></p>
<p>
	<?php echo Html::anchor('home', '<i class="fa fa-chevron-left"></i> 戻る'); ?>　|　
	<?php echo Html::anchor('food/edit/'.$food->id, '<i class="fa fa-wrench"></i> 編集'); ?>
</p>