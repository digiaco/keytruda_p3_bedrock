<?php /* Template Name: GI Archive*/?>
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
	<div class="tabs not-active" id="gi-tabs">
		<ul class="tabset">
			<li class="active"><a href="<?php echo $home_url?>/GI/"><?php pll_e('Colorectal cancer'); ?></a></li>
			<?php if($gi_clinical_title || $gi_desc || $keynotes) { ?>
				<li><a href="<?php echo $home_url?>/GI/esophageal-cancer"><?php pll_e('Esophageal cancer'); ?></a></li>
			<?php } ?>
		</ul>
	    <div id="main-tab">
	    	<?php if($gi_top_text) echo '<div class="intro">'.$gi_top_text.'</div>';?>
	    	<?php if($explore_text) echo '<div class="explore">'.$explore_text.'</div>';?> 
	    	<?php if($gi_indicate_list) { ?>
	    		<div class="indicate-list">
	    			<?php echo $gi_indicate_list;?>
	    		</div>	
	    	<?php } ?>	
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
								<li><button aria-controls="keycontent-<?php echo $i;?>" aria-expanded="false" id="accordion-control-main-<?php echo $i;?>"><?php the_title();?></button>
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
									  		$keynote_btn_type = get_field('k_button_type');
									  		if($keynote_btn_type == 'external') { 
									  			$keynote_url = get_field('k_button_url');
									  		} else{
									  			$keynote_url = get_field('k_button_page');	
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
	      	<?php
	      		$gi_cta_title = get_field('gi_cta_title','options');
	      		$gi_cta_btn = get_field('gi_cta_btn','options');
	      		$gi_cta_btn_name = get_field('gi_cta_btn_name','options');

	      		$gi_cta_title_add = get_field('gi_cta_title_add','options');
	      		$gi_cta_btn_add = get_field('gi_cta_btn_add','options');
	      		$gi_cta_btn_name_add = get_field('gi_cta_btn_name_add','options');
	      	?>
	      	<?php if($gi_cta_title || $gi_cta_btn || $add_indication) { ?>
		      	<div class="overview">
					<div class="wrapper">
						<div class="text-wrapper">
							<?php if($gi_cta_title) echo '<h3>'.$gi_cta_title.'</h3>';?>
							<?php if($gi_cta_btn) echo '<a href="'.$gi_cta_btn.'" class="btn">'.$gi_cta_btn_name.'</a>';?>
						</div>	
						<?php if($add_indication) echo '<div class="add-indication">'.$add_indication.'</div>';?>	
					</div>
				</div>	
			<?php } ?>
			<?php get_template_part('partials/top');?>
			<?php if($gi_ref_add) { ?>
				<div class="ref-text">
					<?php echo $gi_ref_add;?>
				</div>	
			<?php } ?>	
	    </div>
	</div>
</div>

<?php get_footer(); ?>