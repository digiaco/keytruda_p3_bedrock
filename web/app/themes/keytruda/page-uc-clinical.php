<?php /* Template Name: UC Clinical Studies */?>
<?php get_header(); ?> 
<?php
	$uc_top_text = get_field('uc_top_text','options');
	$uc_indicate_list = get_field('uc_list','options');
	$explore_text = get_field('uc_exp_text','options');
	$uc_clinical_title = get_field('uc_cl_main_title','options');
	$uc_desc = get_field('uc_cl_desc','options');	
	$keynotes = get_field('uc_cl_keynotes','options',false, false);
	$cl_studies_ref = get_field('uc_studies_ref','options');
	$main_uc_ref = get_field('main_uc_ref','options');
	$list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'uc',
		'order'=> 'DESC'
	));
	$link_tab = get_field('link_tab_uc','options');
	$link_tab_name = get_field('link_tab_name_uc','options');
	$main_page_url = get_field('uc_url','options');
   	$clinical_url = get_field('uc_clinical_url','options');
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="uc-tabs">
		<ul class="tabset">
			<li><a href="<?php echo $main_page_url?>"><?php pll_e('KEYTRUDA<sup>®</sup> in UC'); ?></a></li>
			<?php if($uc_clinical_title || $uc_desc || $keynotes) { ?>
				<li class="active"><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in UC'); ?></a></li>
			<?php } ?>	
		</ul>
	    <div id="c-studies">
	      	<?php if($uc_clinical_title) echo '<h2>'.$uc_clinical_title.'</h2>';?>
	      	<?php if($uc_desc) echo $uc_desc;?>
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