<?php /* Template Name: RCC Clinical Studies */?>
<?php get_header(); ?>
<?php
	$rcc_top_text = get_field('rcc_top_text','options');
	$rcc_indicate_list = get_field('rcc_list','options');
	$explore_text = get_field('rcc_exp_text','options');
	$rcc_clinical_title = get_field('rcc_cl_main_title','options');
	$rcc_desc = get_field('rcc_cl_desc','options');	
	$keynotes = get_field('rcc_cl_keynotes','options',false, false);
	$cl_studies_ref = get_field('rcc_studies_ref','options');
	$main_rcc_ref = get_field('main_rcc_ref','options');
	$list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'rcc',
		'order' => 'DESC',
	));
	$cancer_statement_title = get_field('cancer_statement_title','options');
	$cancer_statement = get_field('cancer_statement','options');
	$cancer_statement_url = get_field('cancer_statement_url','options');
	$cancer_statement_name = get_field('cancer_statement_name','options'); 
	$main_page_url = get_field('rcc_url','options');
   	$clinical_url = get_field('rcc_clinical_url','options');
?> 
<div class="content-wrapper">	
	<div class="tabs not-active" id="rcc-tabs">
		<ul class="tabset">
			<li><a href="<?php echo $main_page_url;?>"><?php pll_e('KEYTRUDA<sup>®</sup> + axitinib in RCC'); ?></a></li>
			<?php if($rcc_clinical_title || $rcc_desc || $keynotes) { ?>
				<li class="active"><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in RCC'); ?></a></li>
			<?php } ?> 
		</ul>
	    <div id="c-studies">
	      	<?php if($rcc_clinical_title) echo '<h2>'.$rcc_clinical_title.'</h2>';?>
	      	<?php if($rcc_desc) echo $rcc_desc;?>
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
								<li class="keynote-<?php echo $i;?>"><button aria-controls="keycontent-<?php echo $i;?>" aria-expanded="false" id="accordion-control-<?php echo $i;?>"><?php the_title();?></button>
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
	      	<?php if($map_section || $map_section_url) { ?>
	      		<div class="map-section">
	      			<div class="text-wrapper">
	      				<?php if($map_section) echo '<p>'.$map_section.'</p>'?>
	      				<?php if($map_section_url) echo '<a class="btn" href="'.$map_section_url.'">'.$map_section_btn.'</a>';?>
	      			</div>
	      			<div class="map-placer">
	      				<img src="<?php echo get_template_directory_uri()?>/assets/img/blue-map.png" alt="nearest testing centre">
	      			</div>	
	      		</div>	
	      	<?php } ?>	
	      	<?php get_template_part('partials/top');?>
	      	<?php if($cl_studies_ref) { ?>
				<div class="ref-text">
					<?php echo $cl_studies_ref;?>
				</div>	
			<?php } ?>
	    </div>
	</div>
</div>

<?php get_footer(); ?>