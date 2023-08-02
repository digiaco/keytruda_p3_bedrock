<?php /* Template Name: Dosing Faq */ ?>
<?php get_header(); ?>
<?php
	$dosing_faq = get_field('dosing_faq');
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
						<h2><?php echo get_field('intro_title'); ?></h2>
					<?php } ?>

					<?php the_content(); ?>
					<?php if($dosing_faq) { ?>
						<?php $i = 0;?>
						<div class="dosing-faq accordion">
							<ul aria-label="Dosing Faq" class="accordion-controls">
								<?php foreach($dosing_faq as $el) { $i++; ?>
									<?php 
										$title = $el['title'];
										$anchorId = strtolower(esc_attr($el['anchor_id']));
										$editor = $el['editor'];
									?>
									<li id="<?php echo $anchorId; ?>">
										<button 
											aria-controls="faq-<?php echo $i;?>" 
											aria-expanded="false" id="accordion-control-<?php echo $i;?>"
										>
											<?php echo $title;?>
										</button>
										<div aria-hidden="true" class="acc-block keynotes" id="faq-<?php echo $i;?>">
											<?php echo $editor;?>
										</div>	
									</li>	
								<?php } ?>	
							</ul>
						</div>	
					<?php } ?>
					
					<?php if(get_field('title_bottom')){ ?>
						<h3 class="title-bottom"><?php echo get_field('title_bottom'); ?></h3>
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