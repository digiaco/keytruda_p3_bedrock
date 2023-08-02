<?php
	$custom_title = get_field('custom_title');
	$img = get_field('overview_image');
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php if($img) echo '<div class="img-wrapper">'.wp_get_attachment_image( $img, $size = 'overview-img', $icon = false, array('alt'=> 'overview') ).'</div>'; ?>
	<div class="entry-summary">
		<h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo $custom_title ? $custom_title : get_the_title();?></a></h3>
		<?php if(has_excerpt()) { ?>
			<?php echo the_excerpt()?>
		<?php } else { ?>
			<?php echo '<p>'.wp_trim_words( get_the_content(), 45,'...').'</p>';?>
		<?php } ?>
		<a class="btn" href="<?php the_permalink()?>">Learn more</a>	
	</div>		
</article>