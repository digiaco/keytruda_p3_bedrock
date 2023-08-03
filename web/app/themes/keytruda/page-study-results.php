<?php /* Template Name: Study Results */?>
<?php get_header(); ?>
<?php 
	$main_top_bts = get_field('main_top_btns');
	$keynote_rep = get_field('sr_keynotes');
	$keynotes_repeater = get_field('keynotes_repeater');
	$ref = get_field('ref_text');
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="nsclc-tabs">
		<?php if($main_top_bts) { ?>
			<ul class="tabset">
				<?php foreach($main_top_bts as $el) { ?>
					<li <?php if($el['active'] == 1) echo ' class="active"';?>><a href="<?php echo $el['url']?>"><?php echo $el['name']?></a></li>
				<?php } ?>
			</ul>
		<?php } ?>
		
  <div id="c-studies">
    	<?php if($keynote_rep) { ?>
    		<?php $t = 0;?>
    		<?php foreach($keynote_rep as $el) { $t++; ?>

    			<?php
    				$main_title = $el['main_title'];
    				$keynotes = $el['keynotes'];
    			?>
		   		<?php
								$query = new WP_Query(array(
									'post_type'      	=> 'keynotes',
									'posts_per_page'	=> -1,
									'post__in'		=> $keynotes,
									'post_status'		=> 'any',
									'orderby'        	=> 'post__in',
								));
		   		?>
		   		<?php if ($query->have_posts() && $keynotes) : ?>
		    			<div class="accordion keynotes-hold">
										<?php if($main_title) echo '<h2>'.$main_title.'</h2>';?>
										<ul aria-label="Accordion Control Group Buttons" class="accordion-controls accordion-controls-study-results">
											<?php $i=0;?>
											<?php while ($query->have_posts()) : $query->the_post(); $i++; ?>

												<?php
													$guidance_btn = get_field('guidance_btn');
													$guidance_btn_name = get_field('guidance_btn_name');
													$footer_notes = get_field('footer_notes');
													$keynote_sub = get_field('k_sub_title');
													$keynote_add_sub_title = get_field('k_sub_title_a');
													$keynote_anchor = get_field('k_anchor');
													if($keynote_anchor){
														$keynote_anchor = str_replace(" ", "", $keynote_anchor);
													}
												?>
												<li <?php if($keynote_anchor) echo ' id="'.$keynote_anchor.'"'?>>

													<button 
														aria-controls="keycontent-<?php echo $t.$i;?>" 
														aria-expanded="false" id="accordion-control-<?php echo $t.$i;?>"
													>
														<?php the_title();?>
														<?php if($keynote_sub) echo ': '.$keynote_sub; ?>
													</button>

													<div aria-hidden="true" style="display:none" class="acc-block" id="keycontent-<?php echo $t.$i;?>">
																	<div class="keynote-nav">
																		<?php if($keynote_add_sub_title) echo '<p class="title-desc">'.$keynote_add_sub_title.'</p>';?>
																	</div>
																	<div class="keynotes-tabs tabs">
																		<ul class="tabset">
																			<?php if (have_rows('keynote_editor')) { ?>
																				<li>
																					<a href="#study-design">
																						<span><?php pll_e('Study Design'); ?></span>
																					</a>
																				</li>
																			<?php } ?>
																			<?php if (have_rows('efficacy')) { ?>
																				<li>
																					<a href="#efficacy-results">
																						<span><?php pll_e('Efficacy Results'); ?></span>
																					</a>
																				</li>
																			<?php } ?>
																			<?php if (have_rows('s-profile')) { ?>
																				<li>
																					<a href="#safety-profile">
																						<span><?php pll_e('Safety Profile'); ?></span>
																					</a>
																				</li>
																			<?php } ?>
																		</ul>
																		<?php if (have_rows('keynote_editor')) { ?>
																			<div id="study-design" class="tab">
																				<?php
														      		echo '<div class="keynotes">';
															      		while (have_rows('keynote_editor')) { 
																        	the_row();
																									include('partials/keynotes/'.get_row_layout().'.php');
															      		} 
															      		if($footer_notes) echo '<div class="footer-notes">'.$footer_notes.'</div>';
														      		echo '</div>'; 
																					?>
																			</div>	
																		<?php } ?>
																		<?php if (have_rows('efficacy')) { ?>
																			<div id="efficacy-results" class="tab">
																				<?php
														      		echo '<div class="keynotes">';
															      		while (have_rows('efficacy')) { 
																        	the_row();
																									include('partials/keynotes/'.get_row_layout().'.php');
															      		} 
															      		if($footer_notes) echo '<div class="footer-notes">'.$footer_notes.'</div>';
														      		echo '</div>'; 
																					?>
																			</div>	
																		<?php } ?>
																		<?php if (have_rows('s-profile')) { ?>
																			<div id="safety-profile" class="tab">
																				<?php
														      		echo '<div class="keynotes">';
															      		while (have_rows('s-profile')) { 
																        	the_row();
																									include('partials/keynotes/'.get_row_layout().'.php');
															      		}
															      		if($guidance_btn) echo '<div class="guidance-btn"><a href="'.$guidance_btn.'" class="btn light-blue">'.$guidance_btn_name.'</a></div>'; 
															      		if($footer_notes) echo '<div class="footer-notes">'.$footer_notes.'</div>';
														      		echo '</div>'; 
																					?>
																			</div>
																		<?php } ?>
																	</div>
											  	</div>
												
												</li>	
											<?php endwhile?>
									</ul>	
								</div>
						<?php endif;?>
					<?php wp_reset_postdata(); ?>
 			<?php } ?>
 			<?php } ?>	
   	<?php get_template_part('partials/top');?>
   	<?php if($ref) { ?>
				<div class="ref-text">
					<?php echo $ref;?>
				</div>	
			<?php } ?>
			<?php get_template_part('partials/bottom-button');?>
	</div>
		
	</div>
</div>
<?php get_footer(); ?>