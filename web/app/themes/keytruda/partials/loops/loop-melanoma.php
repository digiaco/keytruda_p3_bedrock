<div class="post-el">
	<?php
		$list_photo = get_field('list_img');
		$list_title = get_field('mel_title');
		$list_cont = get_field('c_title');
		$list_cont_res = get_field('c_res');
		$res_title = get_field('res_title');
		$res_img = get_field('res_img');
		if($list_photo){
			$photo = wp_get_attachment_image( $list_photo, 'list-photo', $icon = false, array('alt'=>get_the_title()) );
		} else {
			$photo = get_the_post_thumbnail($size = 'list-photo');
		}
	?>
	<?php if(is_page_template('page-resources.php')) { ?>
		<?php if($res_img) echo wp_get_attachment_image( $res_img, 'list-photo', $icon = false, array('alt'=>get_the_title()) );?>
	<?php } else { ?>	
		<?php if($photo) echo $photo;?>
	<?php } ?>
	<div class="text-wrapper">
		<?php if(is_page_template('page-resources.php')) { ?>
			<?php if($res_title) echo '<h3>'.$res_title.'</h3>';?>
			<?php if($list_cont_res) echo '<div class="c-text">'.$list_cont_res.'</div>';?> 
			<form method="post" action="<?php the_permalink()?>">
				<input type="hidden" value="<?php echo home_url($wp->request)?>" name="ref-link">
				<button class="btn" type="submit"><?php pll_e('Learn more'); ?></button> 
			</form>
		<?php } else { ?>	
			<?php if($list_title) { ?>
				<h3><?php echo $list_title;?></h3>
			<?php } else {  ?>
				<h3><?php the_title();?></h3>
			<?php } ?>
			<?php if($list_cont) echo '<div class="c-text">'.$list_cont.'</div>';?>
			<a class="btn" href="<?php the_permalink()?>"><?php pll_e('Learn more'); ?></a>
		<?php } ?>
		
	</div>	
</div>