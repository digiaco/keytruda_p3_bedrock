<?php /*Template Name: Clinical Studies */ ?>
<?php get_header(); ?>
<?php
	$trial_boxes = get_field('trial_boxes');
	$page_ref = get_field('ref_text');
?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">
					<?php if($trial_boxes) { ?>
						<div class="trial-list">
							<div class="accordion keynotes-hold">
									<ul aria-label="Accordion Control Group Buttons" class="accordion-controls">
										<?php $i = 0;?>
										<?php foreach($trial_boxes as $item) {  ?>
											<?php $i++; ?>
											<?php
												$title = $item['title'];
												$trials = $item['trials'];
												$icon = $item['icon'];
											?>
											<li>
												<button aria-controls="trial-<?php echo $i;?>" aria-expanded="false" id="accordion-control-<?php echo $i;?>"><?php echo $title;?></button>
												<div aria-hidden="true" style="display:none" class="acc-block" id="trial-<?php echo $i;?>">
													<?php if($trials) { ?>
														<div class="hold">
															<div class="trials">
																<?php foreach($trials as $el) { ?>
																	<?php
																		$name = $el['name'];
																		$btn_type = $el['btn_type'];
																		if($btn_type == 'external') {
																			$btn = $el['btn'];
																		} else {
																			$btn = $el['btn_in'];
																		}	
																	?>
																	<div class="trial">
																		<?php if($name) echo '<p>'.$name.'</p>';?>
																		<?php if($btn) echo '<a class="btn" href="'.$btn.'">'.$el['btn_name'].'</a>';?>
																	</div>	
																<?php } ?>	
															</div> 
															<?php if($icon) echo wp_get_attachment_image( $icon, 'trial-icon', $icon = false, array('alt'=>$title) ); ?> 
														</div>	
													<?php } ?>	
												</div>	
											</li>
										<?php } ?>
									</ul>
							</div>			
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