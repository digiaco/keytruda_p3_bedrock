<?php get_header(); ?>
<?php 
	$overview_title = get_field('overview_title');
	$overview_image = get_field('overview_image');
	$overview_file = get_field('overview_file');
	$overview_btn = get_field('overview_btn');
	$add_btn = get_field('add_btn');
	$add_btn_name = get_field('add_btn_name');
	$promo_title = get_field('promo_title');
	$promo_desc = get_field('promo_desc');

	$promo_btn_type = get_field('pr_button_type');
	$promo_img = get_field('promo_img');
	if($promo_btn_type == 'external'){
		$promo_btn_url = get_field('promo_btn_url');	
	}
	elseif($promo_btn_type == 'internal'){
		$promo_btn_url = get_field('promo_btn_url_in');	
	}else{
		$promo_btn_url = get_field('promo_btn_url_file');
	}
	
	$promo_btn_name = get_field('promo_btn_name');
?>
<?php $custom_title = get_field('custom_title');?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="content-wrapper">
				<div class="entry-content">
					<div class="entry-wrapper">
						<?php the_content(); ?>
					</div>
					<?php if($overview_title || $overview_image || $overview_file) { ?>
						<div class="overview">
							<div class="wrapper">
								<?php if($overview_image) echo '<div class="img-wrapper">'.wp_get_attachment_image( $overview_image, $size = 'overview-hnscc', $icon = false, array('alt'=> $overview_title) ).'</div>'; ?>
								<?php if($overview_file || $overview_title) { ?>
									<div class="text-wrapper">
										<?php if($overview_title) echo '<h3>'.$overview_title.'</h3>';?>
										<?php if($overview_file) echo '<a href="'.$overview_file.'" class="btn first">'.$overview_btn.'</a>';?>
										<?php if($add_btn) echo '<div><a class="btn" href="'.$add_btn.'">'.$add_btn_name.'</a></div>';?>
									</div>	
								<?php } ?>	
								<img src="<?php echo get_template_directory_uri()?>/assets/img/iconstudy-grey.png" class="grey-icon" alt="grey-icon">
							</div>
						</div>	
					<?php } ?>		
				</div>
			</div>
		</article>
		<?php if($promo_title || $promo_desc) { ?>
			<div class="add-promo">
				<div class="content-wrapper">
					<div class="wrapper">
						<?php if($promo_title || $promo_desc) { ?>
							<div class="text-wrapper">
								<?php if($promo_title) echo '<h3>'.$promo_title.'</h3>';?>
								<?php if($promo_desc) echo '<p>'.$promo_desc.'</p>';?>
								<?php if($promo_btn_url || $promo_btn_name) { ?>
									<a class="btn" target="_blank" rel="noopener noreferrer" href="<?php echo $promo_btn_url;?>"><?php echo $promo_btn_name;?></a>
								<?php } ?>	
							</div>	
						<?php } ?>
						<?php if($promo_img) { ?>
							<div class="img-wrapper">

								<div class="img-hold">
									<img class="desktop-map" src="<?php echo get_template_directory_uri()?>/assets/img/k-img.png" alt="<?php echo $promo_title;?>">
									<img class="mobile-map" aria-hidden="true" src="<?php echo get_template_directory_uri()?>/assets/img/gi-map-mobile.png" alt="Mobile <?php echo $promo_title;?>">

								</div>
							</div>	
						<?php } ?>		
					</div>
				</div>	
			</div>	
		<?php } ?>
		<?php get_template_part('partials/top');?>
		<?php get_template_part('partials/ref');?>
	<?php endwhile; else: ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
<?php get_footer(); ?>