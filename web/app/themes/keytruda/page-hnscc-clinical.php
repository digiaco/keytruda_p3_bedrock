<?php /* Template Name: HNSCC Clinical Studies */?>
<?php get_header(); ?>
<?php
	$hnscc_top_text = get_field('hnscc_top_text','options');
	$hnscc_indicate_list = get_field('hnscc_list','options');
	$explore_text = get_field('hnscc_exp_text','options');
	$hnscc_clinical_title = get_field('hnscc_cl_main_title','options');
	$hnscc_desc = get_field('hnscc_cl_desc','options');	
	$keynotes = get_field('hnscc_cl_keynotes','options',false, false);
	$cl_studies_ref = get_field('hnscc_studies_ref','options');
	$map_section = get_field('map_section_desc','options');
	$map_section_btn = get_field('map_section_btn','options');
	$map_section_url = get_field('map_section_btn_url','options');
	$map_section_main = get_field('map_section_desc_main','options');
	$map_section_btn_main = get_field('map_section_btn_main','options');
	$map_section_url_main = get_field('map_section_btn_url_main','options');
	$handbook_img = get_field('hand_book','options');
	$handbook_title = get_field('hand_book_title','options');
	$handbook_btn_url = get_field('hand_book_btn_url','options');
	$handbook_btn_name = get_field('hand_book_btn_name','options');
	$main_hnscc_ref = get_field('main_hnscc_ref','options');
	$main_page_url = get_field('hnscc_url','options');
   	$clinical_url = get_field('hnscc_clinical_url','options');
	
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="hnscc-tabs">
		<ul class="tabset">
			<li><a href="<?php echo $main_page_url?>"><?php pll_e('KEYTRUDA<sup>®</sup> in HNSCC'); ?></a></li>
			<?php if($hnscc_clinical_title || $hnscc_desc || $keynotes || $map_section) { ?> 
				<li class="active"><a href="<?php echo $clinical_url; ?>" ><?php pll_e('Clinical studies in HNSCC'); ?></a></li>
			<?php } ?>
		</ul>
	    <div id="c-studies">
	      	<?php if($hnscc_clinical_title) echo '<h2>'.$hnscc_clinical_title.'</h2>';?>
	      	<?php if($hnscc_desc) echo $hnscc_desc;?>
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
						<ul aria-label="Keynotes Accordion" class="accordion-controls">
							<?php $i=0;?>
							<?php while ($query->have_posts()) : $query->the_post(); $i++; ?>
								<li><button aria-controls="keycontent-<?php echo $i;?>" aria-expanded="false" id="accordion-control-<?php echo $i;?>"><?php the_title();?></button>
									<div aria-hidden="true" class="acc-block" style="display:none" id="keycontent-<?php echo $i;?>">
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
	      				<img  style="max-width:503px;"  src="<?php echo get_template_directory_uri()?>/assets/img/blue-map.png" alt="nearest testing centre">
	      				<img src="<?php echo get_template_directory_uri()?>/assets/img/blue-map-mobile.png" role="presentation" class="mobile" alt="">
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