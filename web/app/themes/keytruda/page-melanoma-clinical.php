<?php /* Template Name: Melanoma Clinical Studies */?>
<?php get_header(); ?>
<?php
	$mel_top_text = get_field('mel_top_text','options');
	$mel_indicate_list = get_field('mel_list','options');
	$explore_text = get_field('mel_exp_text','options');
	$mel_clinical_title = get_field('mel_cl_main_title','options');
	$mel_desc = get_field('mel_cl_desc','options');	
	$keynotes = get_field('mel_cl_keynotes','options',false, false);
	$mel_ref = get_field('mel_ref','options');
	$cl_mel_ref = get_field('mel_ref_cl','options');
	$offers_title = get_field('offers_title','options');
	$offers_desc = get_field('offers_desc','options');
	$offers_btn = get_field('offers_btn','options');
	$offers_btn_name = get_field('offers_btn_name','options');
	$offers_btn_bottom_text = get_field('offers_btn_text','options');
	$offers_img = get_field('offers_img','options');
	$add_desc = get_field('add_desc','options');
	
	$list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'melanoma',
		'order' => 'DESC',
	));
	$main_page_url = get_field('mel_url','options');
   	$clinical_url = get_field('mel_clinical_url','options');
?>
<div class="content-wrapper">	
	<div class="tabs not-active" id="uc-tabs">
		<ul class="tabset">
			<li><a href="<?php echo $main_page_url;?>"><?php pll_e('KEYTRUDA<sup>®</sup> in melanoma'); ?></a></li>
			<?php if($mel_clinical_title || $mel_desc || $keynotes) { ?>  
			<li class="active"><a href="<?php echo $clinical_url;?>"><?php pll_e('Clinical studies in melanoma'); ?></a></li>	
			<?php } ?>
		</ul>
	    <div id="c-studies">
	      	<?php if($mel_clinical_title) echo '<h2>'.$mel_clinical_title.'</h2>';?>
	      	<?php if($mel_desc) echo $mel_desc;?>
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
	      	<?php if($cl_mel_ref) { ?>
				<div class="ref-text">
					<?php echo $cl_mel_ref;?>
				</div>	
			<?php } ?>
	    </div>
	</div>
</div>

<?php get_footer(); ?>