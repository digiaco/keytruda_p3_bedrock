<?php
	$custom_title = get_field('custom_title');
	$img = get_field('overview_image');
	$res_img = get_field('overview_image_res');
	$overview_file = get_field('overview_file');
	$overview_btn = get_field('overview_btn');
	$resources_title = get_field('resources_title');
	$resources_text = get_field('resources_text');
	$list_title = get_field('nsclc_title_add');
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php if(is_page_template('page-resources.php')) { ?>
		<?php if($res_img) echo '<div class="img-wrapper">'.wp_get_attachment_image( $res_img, $size = 'overview-img', $icon = false, array('alt'=> 'overview') ).'</div>'; ?>
	<?php } else { ?>
		<?php if($img) echo '<div class="img-wrapper">'.wp_get_attachment_image( $img, $size = 'overview-img', $icon = false, array('alt'=> 'overview') ).'</div>'; ?>
	<?php } ?>		
	<div class="entry-summary">
		<?php if(is_page_template('page-resources.php')) { ?>
			<form method="post" action="<?php the_permalink()?>">
				<input type="hidden" value="<?php echo home_url($wp->request)?>" name="ref-link">
				<button class="input-title" type="submit">
					<?php if($resources_title) { ?>
						<?php echo $resources_title;?>
					<?php } ?>
				</button> 
			</form>
		<?php } else { ?>
			
				<?php if($list_title) { ?>
				<h3 class="entry-title"><a tabindex="-1" href="<?php the_permalink() ?>" rel="bookmark"><?php echo $list_title;?></a></h3>
				<?php } else { ?>	
					<h3 class="entry-title"><a tabindex="-1" href="<?php the_permalink() ?>" rel="bookmark"><?php echo $custom_title ? $custom_title : get_the_title();?></a></h3>
				<?php } ?>
		<?php } ?>	
		
		<?php if(is_page_template('page-resources.php')) { ?>
			<?php echo $resources_text;?>
			<a class="btn" href="<?php echo $overview_file;?>"><?php echo $overview_btn;?></a>	
		<?php } else { ?>
			<?php if(has_excerpt()) { ?>
				<?php echo the_excerpt()?>
			<?php } else { ?>
				<?php echo '<p>'.wp_trim_words( get_the_content(), 45,'...').'</p>';?>
			<?php } ?>
			<a class="btn" href="<?php the_permalink()?>"><?php pll_e('Learn more'); ?></a>	
		<?php } ?>	
	</div>		
</article>