<div class="post-el">
	<?php
		$list_photo = get_field('list_img');
		$list_title = get_field('list_title');
		$overview_file = get_field('overview_file');
		$overview_btn = get_field('overview_btn');
		$resources_title = get_field('resources_title');
		$resources_desc = get_field('resources_desc');
		$res_img = get_field('res_img');
		if($list_photo){
			$photo = wp_get_attachment_image( $list_photo, 'list-photo', $icon = false, array('alt'=>strip_tags($list_title) ) );
		} else {
			$photo = get_the_post_thumbnail($size = 'list-photo'); 
		}
	?>
	<?php if(is_page_template('page-resources.php')) { ?>
		<?php echo wp_get_attachment_image( $res_img, 'list-photo', $icon = false, array('alt'=>strip_tags($list_title) )); ?>
	<?php } else {  ?>
		<?php if($photo) echo $photo;?>
	<?php } ?>	
	<div class="text-wrapper">
		<?php if(is_page_template('page-resources.php')) { ?>
			<?php if($resources_title) { ?>
				<h3><?php echo $resources_title;?></h3>
			<?php } ?>	
			<?php if($resources_desc) { ?>
				<?php echo $resources_desc;?>
			<?php } ?>	
			<a class="btn" href="<?php echo $overview_file;?>"><?php echo $overview_btn;?></a>		
		<?php } else {  ?> 
			<?php if($list_title) { ?>
				<h3><?php echo $list_title;?></h3>
			<?php } else {  ?>
				<h3><?php the_title();?></h3>
			<?php } ?>
			<a class="btn" href="<?php the_permalink()?>"><?php pll_e('Learn more'); ?></a>		
		<?php } ?>	
	</div>	
</div>