<?php /*Template Name: AE Management */ ?>
<?php get_header(); ?>
<?php
	$dosing_rep = get_field('dosing_rep');
	$page_ref = get_field('ref_text');
?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">

					<?php if(get_field('intro_title')){ ?>
						<h3 class="intro-title"><?php echo get_field('intro_title'); ?></h3>
					<?php } ?>

					<?php if(get_field('intro_content')){ ?>
						<div class="intro-content"><?php echo get_field('intro_content'); ?></div>
					<?php } ?>

					<?php if($dosing_rep) { ?>
						<div class="dosing-list">
							<?php foreach($dosing_rep as $item) {  ?>
								<?php
									$title = $item['title'];
									$content = $item['content'];
									$icon = $item['icon'];
									$btn_type = $item['btn_type'];
									$section_id = $item['section_id'];
									if($btn_type == 'url') { 
										$url = $item['url'];
									} else {
										$url = $item['url_file'];
									}
									$btn = $item['btn']; 
								?>
								<div class="el" <?php if($section_id) echo ' id="'.$section_id.'"'?>>
									<?php if($icon) { ?>
										<div class="img-wrapper">
											<?php echo wp_get_attachment_image( $icon, 'icon', $icon = false, array('alt'=>strip_tags($title) ) ); ?>
										</div>
									<?php } ?>
									<?php if($title || $btn || $content) { ?>
										<div class="text-wrapper">
											<?php if($title){ ?>
												<h2><?php echo $title;?></h2>
											<?php } ?>
											<?php if($content){ ?>
												<div class="text-wrapper-content"><?php echo $content;?></div>
											<?php } ?>
											<?php if($url && $btn){ ?>
												 <a class="btn" href="<?php echo $url; ?>"><?php echo $btn; ?></a>
											<?php } ?>
										</div>
									<?php } ?>	
								</div>
							<?php } ?>	
						</div>	
					<?php } ?>	

					<?php if(get_field('content_bottom')){ ?>
						<div class="content-bottom"><?php echo get_field('content_bottom'); ?></div>
					<?php } ?>

				</div>
				<?php get_template_part('partials/top');?>
		      	<?php if($page_ref) { ?>
					<div class="ref-text">
						<?php echo $page_ref;?>
					</div>	
				<?php } ?>
			</div>
		</article>

	<?php
			endwhile;
		else:
			get_template_part('404');
		endif;
	?>
<?php get_footer(); ?>