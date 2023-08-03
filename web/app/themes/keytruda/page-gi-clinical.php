<?php /* Template Name: GI Clinical Studies*/?>
<?php get_header(); ?>
<?php
	$gi_top_text = get_field('gi_top_text','options');
	$gi_indicate_list = get_field('gi_list','options');
	$explore_text = get_field('gi_exp_text','options');
	$gi_clinical_title = get_field('gi_cl_main_ab_title','options');
	$gi_desc = get_field('gi_cl_desc','options');	
	$keynotes = get_field('gi_keynotes','options',false, false);
	$keynotes_add = get_field('gi_st_keynotes','options',false, false);
	$gi_ref = get_field('gi_ref','options');
	$gi_ref_add = get_field('gi_ref_add','options');
	$cl_gi_ref = get_field('gi_ref_cl','options');
	
	$gi_map_title = get_field('gi_map_title','options');
	$gi_map_section_btn = get_field('gi_map_section_btn','options');
	$gi_map_section_url = get_field('gi_map_section_btn_url','options');
	$add_indication = get_field('gi_cta_add_ind','options');
	$add_indication_es = get_field('gi_cta_add_ind_es','options');
	$list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'melanoma', 
	));
	if(ICL_LANGUAGE_CODE =='en') { 
		$home_url = home_url();
	} else{
		$home_url = pll_home_url('en').'fr'; 
	} 
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="uc-tabs">
		<ul class="tabset">
			<li><a href="<?php echo $home_url?>/GI/"><?php pll_e('Colorectal cancer'); ?></a></li>
			<?php if($gi_clinical_title || $gi_desc || $keynotes) { ?>
				<li class="active"><a href="<?php echo $home_url?>/GI/esophageal-cancer"><?php pll_e('Esophageal cancer'); ?></a></li>
			<?php } ?>
		</ul>
	    <div id="c-studies">
	      	<?php if($gi_clinical_title) echo '<h2>'.$gi_clinical_title.'</h2>';?>
	      	<?php if($gi_desc) echo $gi_desc;?>
	      	<?php if($keynotes_add) { ?>
	      		<?php
					$query = new WP_Query(array(
						'post_type'      	=> 'keynotes',
						'posts_per_page'	=> -1,
						'post__in'		=> $keynotes_add,
						'post_status'		=> 'any',
						'orderby'        	=> 'post__in',
					));
	      		?>
	      		<?php if ($query->have_posts()) : ?>
	      			<div class="accordion keynotes-hold">
						<ul aria-label="Accordion Control Group Buttons" class="accordion-controls">
							<?php $i=0;?>
							<?php while ($query->have_posts()) : $query->the_post(); $i++; ?>
								<li><button aria-controls="keycontent-add-<?php echo $i;?>" aria-expanded="false" id="accordion-control-<?php echo $i;?>"><?php the_title();?></button>
									<div aria-hidden="true" style="display:none" class="acc-block" id="keycontent-add-<?php echo $i;?>">
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
	      	<?php /* if($gi_map_section || $gi_section_url) { */?>
	      		<div class="map-section">
	      			<div class="text-wrapper">
	      				<?php if($gi_map_title) echo '<p>'.$gi_map_title.'</p>'?>
	      				<?php if($gi_map_section_url) { ?>
	      					<a class="btn" href="<?php echo $gi_map_section_url?>"><?php echo $gi_map_section_btn; ?></a>
	      				<?php } ?>
	      			</div>
	      			<div class="map-placer">
	      				<img style="max-width: 503px;" src="<?php echo get_template_directory_uri()?>/assets/img/blue-map.png" alt="nearest testing centre">
	      				<img src="<?php echo get_template_directory_uri()?>/assets/img/blue-map-mobile.png" role="presentation" class="mobile" alt="">
	      			</div>	
	      		</div>	
	      	<?php /* } */?>	
	      	<?php
	      		$gi_cta_title_add = get_field('gi_cta_title_add','options');
	      		$gi_cta_btn_add = get_field('gi_cta_btn_add','options');
	      		$gi_cta_btn_name_add = get_field('gi_cta_btn_name_add','options');
	      	?>
	      	<?php if($gi_cta_title_add || $gi_cta_btn_add || $add_indication) { ?>
		      	<div class="overview">
					<div class="wrapper">
						<div class="text-wrapper">
							<?php if($gi_cta_title_add) echo '<h3>'.$gi_cta_title_add.'</h3>';?>
							<?php if($gi_cta_btn_add) echo '<a href="'.$gi_cta_btn_add.'" class="btn">'.$gi_cta_btn_name_add.'</a>';?>
						</div>
						<?php if($add_indication_es) echo '<div class="add-indication">'.$add_indication_es.'</div>';?>	
					</div>
				</div>	
			<?php } ?>
	      	<?php get_template_part('partials/top');?>
	      	<?php if($gi_ref) { ?>
				<div class="ref-text">
					<?php echo $gi_ref;?>
				</div>	
			<?php } ?>	
	    </div>
	</div>
</div>

<?php get_footer(); ?>