<!-- .foodThumbnail -->
<div class="foodThumbnail">
	<div class="box box-widget">
        <div class="box-header with-border">
			<div class="user-block">
				<img class="img-circle" src="/dist/img/user1-128x128.jpg" alt="User Image">
				<span class="username">
					<a href="/food/edit/<?php echo $food->id; ?>"><?php echo $food->name; ?></a>
				</span>
				<span class="description"><?php echo Date::forge($food->updated_at)->format("%Y年%m月%d %H:%M"); ?></span>
			</div>
			<!-- /.user-block -->
			<div class="box-tools">
			</div>
			<!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
			<img class="img-responsive pad" src="<?php echo $food->image_1; ?>" alt="Photo">
			<span class="pull-right text-muted">〇〇 likes</span>
        </div>
        <!-- /.box-body -->
	</div>
</div>

