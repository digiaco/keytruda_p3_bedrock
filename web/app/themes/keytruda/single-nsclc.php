<?php get_header(); ?>
<?php 
	$overview_title = get_field('overview_title');
	$custom_title_single = get_field('custom_title_single');
	$overview_image = get_field('overview_image');
	$overview_file = get_field('overview_file');
	$overview_btn = get_field('overview_btn');

?>
<?php $custom_title = get_field('custom_title');?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="content-wrapper">
				<div class="entry-content">
					<div class="entry-wrapper">
						<h1 class="entry-title"><?php echo ($custom_title_single ? $custom_title_single: get_the_title())?></h1>
						<?php the_content(); ?>
					</div>
					<?php if($custom_title_single || $overview_image || $overview_file) { ?>
						<div class="overview">
							<div class="wrapper">
								<?php if($overview_image) echo '<div class="img-wrapper">'.wp_get_attachment_image( $overview_image, $size = 'overview-img', $icon = false, array('alt'=> $overview_title) ).'</div>'; ?>
								<?php if($overview_file || $overview_title) { ?>
									<div class="text-wrapper">
										<?php if($overview_title) echo '<h3>'.$overview_title.'</h3>';?>
										<?php if($overview_file) echo '<a href="'.$overview_file.'" class="btn">'.$overview_btn.'</a>';?>
									</div>	
								<?php } ?>	
							</div>
						</div>	
					<?php } ?>	
					<?php get_template_part('partials/post-nav');?>
				</div>
			</div>
		</article>
		<?php get_template_part('partials/top');?>
		<?php get_template_part('partials/ref');?>
	<?php endwhile; else: ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
<?php get_footer(); ?>