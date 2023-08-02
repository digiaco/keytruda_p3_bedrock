<?php /* Template Name: NSCLC Clinical Studies */?>
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
	//$child = get_pages('child_of='.$post->post_parent.'&sort_column=menu_order'); 
	$main_page_url = get_field('nsclc_url','options');
   	$clinical_url = get_field('nsclc_clinical_url','options');
   	$programs_url = get_field('nsclc_program_url','options');
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="nsclc-tabs">
		<ul class="tabset">
			<?php if($nsclc_top_text || $nsclc_indicate_list || $explore_text) { ?>
				<li><a href="<?php echo $main_page_url?>"><?php pll_e('KEYTRUDA<sup>®</sup> in NSCLC'); ?></a></li>
			<?php } ?>
			<?php if($nsclc_clinical_title || $nsclc_desc || $keynotes) { ?>
				<li class="active"><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in NSCLC'); ?></a></li>
			<?php } ?>
			<li><a href="<?php echo $programs_url?>" ><?php pll_e('Clinical program in NSCLC'); ?></a>
		</ul>
		<?php if($nsclc_clinical_title || $nsclc_desc || $keynotes) {?>  
	    <div id="c-studies">
	      	<?php if($nsclc_clinical_title) echo '<h2>'.$nsclc_clinical_title.'</h2>';?>
	      	<?php if($nsclc_desc) echo $nsclc_desc;?>
	      	<?php if($keynotes) { ?>
	      		<?php
					$query = new WP_Query(array(
						'post_type'      	=> 'keynotes',
						'posts_per_page'	=> -1,
						'post__in'		=> $keynotes,
						'post_status'		=> 'any',
						'orderby'        	=> 'post__in',
					));
	      		?>
	      		<?php if ($query->have_posts()) : ?>
	      			<div class="accordion keynotes-hold">
						<ul aria-label="Accordion Control Group Buttons" class="accordion-controls">
							<?php $i=0;?>
							<?php while ($query->have_posts()) : $query->the_post(); $i++; ?>
								<li><button aria-controls="keycontent-<?php echo $i;?>" aria-expanded="false" id="accordion-control-<?php echo $i;?>"><?php the_title();?></button>
									<div aria-hidden="true" style="display:none" class="acc-block" id="keycontent-<?php echo $i;?>">
										<?php
											if (have_rows('keynote_editor')) {
									      		echo '<div class="keynotes">';
										      		while (have_rows('keynote_editor')) { 
											        	the_row();
														include('partials/keynotes/'.get_row_layout().'.php');
										      		} 
									      		echo '</div>';
										    } 
										?>
										<?php
									  		$keynote_bottom_title = get_field('k_add_title');
									  		$k_button_type = get_field('k_button_type');
									  		if($k_button_type == 'internal') { 
									  			$keynote_url = get_field('k_button_page');
									  			
									  		} elseif($k_button_type == 'file'){
									  			$keynote_url = get_field('k_button_file');
									  		} else { 
									  			$keynote_url = get_field('k_button_url');
									  		}
									  		
									  		$keynote_name = get_field('k_button_name');
									  	?>
									  	<?php if($keynote_bottom_title || $keynote_url) { ?>
										  	<div class="bottom-button">
										  		<?php if($keynote_bottom_title) echo '<h4>'.$keynote_bottom_title.'</h4>';?>
										  		<?php if($keynote_url) echo '<a class="btn" href="'.$keynote_url.'">'.$keynote_name.'</a>'?>
										  	</div>	
									  	<?php } ?>
								  	</div>
								</li>	
							<?php endwhile?>
						</ul>	
					</div>
					<?php endif;?>
				<?php wp_reset_postdata(); ?>
	      	<?php } ?>	
	      	<?php get_template_part('partials/top');?>
	      	<?php if($cl_studies_ref) { ?>
				<div class="ref-text">
					<?php echo $cl_studies_ref;?>
				</div>	
			<?php } ?>
	    </div>
		<?php } ?> 
	</div>
</div>
<?php get_footer(); ?>