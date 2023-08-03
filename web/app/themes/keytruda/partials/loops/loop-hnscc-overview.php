<div class="post-el">
	<?php
		$list_photo = get_field('list_img');
		$list_title = get_field('list_title');
		$overview_title = get_field('overview_title');
		$overview_image = get_field('overview_image');
		$overview_file = get_field('overview_file');
		$overview_btn = get_field('overview_btn');
		$resources_title = get_field('resources_title');
		if($overview_image) {
			$photo = wp_get_attachment_image( $overview_image, 'overview-hnscc', $icon = false, array('alt'=>get_the_title()) );
		} else {
			$photo = get_the_post_thumbnail($size = 'overview-hnscc');
		}
	?>
	<?php if($photo) echo $photo;?>
	<div class="text-wrapper">
		<?php if(is_page_template('page-resources.php')) { ?>
			<?php if($resources_title) { ?>
				<h3><?php echo $resources_title;?></h3>
			<?php } elseif($list_title) { ?>
				<h3><?php echo $list_title;?></h3>
			<?php } else {  ?>
				<h3><?php the_title();?></h3>
			<?php } ?>
		<?php } else { ?>
			<?php if($list_title) { ?>
				<h3><?php echo $list_title;?></h3>
			<?php } else {  ?>
				<h3><?php the_title();?></h3>
			<?php } ?>
		<?php } ?>		
		<?php if(is_page_template('page-resources.php')) { ?>
			<a class="btn" href="<?php echo $overview_file;?>"><?php echo $overview_btn;?></a>
		<?php } else { ?>
			<a class="btn" href="<?php the_permalink()?>">Learn more</a>		
		<?php } ?>		
		
	</div>	
</div>