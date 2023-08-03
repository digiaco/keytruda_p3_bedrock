<?php /* Template Name: NSCLC Archive */?>
<?php get_header(); ?>
<?php 
	$nsclc_top_text = get_field('nsclc_top_text','options');
	$nsclc_indicate_list = get_field('nsclc_list','options');
	$explore_text = get_field('exp_text','options');
	$nsclc_clinical_title = get_field('nsclc_cl_main_title','options');
	$nsclc_desc = get_field('nsclc_cl_desc','options');	
	$keynotes = get_field('nsclc_cl_keynotes','options',false, false);
	$cl_program_line_title = get_field('cl_program_line_title','options');
	$cl_program_editor = get_field('cl_program_editor','options');
	$cl_overview = get_field('cl_overview','options');
	$main_nsclc_ref = get_field('main_nsclc_ref','options');
	$cl_studies_ref = get_field('cl_studies_ref','options');
	$cl_program_ref = get_field('cl_program_ref','options');
	/*
	$parentid = get_the_ID();
   	$child = get_pages('child_of='.$parentid.'&sort_column=menu_order'); 
   	*/
   	$main_page_url = get_field('nsclc_url','options');
   	$clinical_url = get_field('nsclc_clinical_url','options');
   	$programs_url = get_field('nsclc_program_url','options');

?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="nsclc-tabs">
		<ul class="tabset">
			<?php if($nsclc_top_text || $nsclc_indicate_list || $explore_text) { ?>
				<li class="active"><a href="<?php echo $main_page_url?>"><?php pll_e('KEYTRUDA<sup>®</sup> in NSCLC'); ?></a></li>
			<?php } ?>
			<?php if($nsclc_clinical_title || $nsclc_desc || $keynotes) { ?>
				<li><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in NSCLC'); ?></a></li>
			<?php } ?>
			<li><a href="<?php echo $programs_url;?>" ><?php pll_e('Clinical program in NSCLC'); ?></a>
		</ul>
  	
	  	<?php if($nsclc_top_text || $nsclc_indicate_list || $explore_text) { ?>
		    <div id="main-tab">
		    	<?php if($nsclc_top_text) echo '<div class="intro">'.$nsclc_top_text.'</div>';?>
		    	<?php if($nsclc_indicate_list) { ?>
		    		<div class="indicate-list">
		    			<?php echo $nsclc_indicate_list;?>
		    		</div>	
		    	<?php } ?>	
		    	<?php if($explore_text) echo '<div class="explore">'.$explore_text.'</div>';?> 
		    	<?php
					$nsclc_cats = get_terms( 'nsclc_category', array(
				    	'hide_empty' => true,
					));

					if($nsclc_cats) { 
				?>
					<div class="nsclc-cats">
						<div class="content-wrapper">
							<div class="accordion">
								<ul aria-label="Accordion Control Group Buttons" class="accordion-controls">
									<?php $i = 0;?>
									<?php foreach($nsclc_cats as $el) { ?>
										<?php $i++;?>
										<?php $desc = term_description($el->term_id);?>
										<li>
											<button aria-controls="content-<?php echo $i;?>" aria-expanded="false" id="accordion-control-cats-<?php echo $i;?>"><?php echo $el->name;?></button>
											<div aria-hidden="true" style="display:none" class="acc-block" id="content-<?php echo $i;?>">
												<?php if($desc) echo '<div class="desc">'.$desc.'</div>';?>
										    	<?php
													$list = new WP_Query(array(
														'posts_per_page' => -1,
														'post_type' => 'nsclc',
														'order' => 'DESC',
														'orderby' => 'menu_order',
														'tax_query' => array(
										                    array(
										                        'taxonomy' => 'nsclc_category',
										                        'field' => 'term_id',
										                        'terms' => $el->term_id,
										                        
										                    )
										                )
										        	));
												?>
												<?php if ($list->have_posts()) : ?>
													<div class="c-posts">
														<?php while ($list->have_posts()) : $list->the_post(); ?>
															<?php get_template_part('partials/loops/loop','nsclc');?>	
														<?php endwhile?>
													</div>
												<?php endif;?>
												<?php wp_reset_postdata(); ?>
										  	</div>
										</li>
									<?php } ?>
						 	 	</ul>
							</div>
						</div>	
					</div>	
				<?php } ?> 
				<?php get_template_part('partials/top');?>
				<?php if($main_nsclc_ref) { ?>
					<div class="ref-text">
						<?php echo $main_nsclc_ref;?>
					</div>	
				<?php } ?>	
		    </div>
		<?php } ?> 
	</div>
</div>
<?php get_footer(); ?>