<?php /*Template Name: Main Resources Page */ ?>
<?php get_header(); ?>
<?php
	$main_res_links = get_field('main_res_links');
	$page_ref = get_field('ref_text');
?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">
					<?php if($main_res_links) { ?>
						<div class="dosing-list">
							<?php foreach($main_res_links as $item) {  ?>
								<?php
									$title = $item['title'];
									$icon = $item['icon'];
									$btn_type = $item['btn_type'];
									if($btn_type == 'url') { 
										$url = $item['url'];
									} elseif($btn_type == 'file') {
										$url = $item['url_file'];
									} 
									$btn = $item['btn']; 
								?>
								<div class="el">
									<div class="img-wrapper"><?php echo wp_get_attachment_image( $icon, 'icon', $icon = false, array('alt'=>strip_tags($title) ) );?></div>
									<?php if($title || $btn) { ?>
										<div class="text-wrapper">
											<h2><?php echo $title;?></h2>
											<?php if($btn_type == 'content') { ?>
												<?php if($url) echo '<a class="btn opener" href="'.$url.'"><span class="open">Open <em>Arrow</em></span><span class="close">Close <em>Arrow</em></span></a>';?>
											<?php  } else { ?>
												<?php if($url) echo '<a class="btn" href="'.$url.'">'.$btn.'</a>';?>
											<?php } ?>	
										</div>
										<?php } ?>	
								</div>
							<?php } ?>	
						</div>	
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