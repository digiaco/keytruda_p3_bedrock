<?php /* Template Name: Indications */?>
<?php get_header(); ?>
<?php 
	$main_top_bts = get_field('main_top_btns');
	$explore_text = get_field('exp_text');
	$exp_id = get_field('exp_section_id');
	$explore_text_btn = get_field('exp_text_btn');
	$explore_text_btn_name = get_field('exp_text_btn_name');
	$reim_text = get_field('reim_text');
	$reim_text_id = get_field('reim_text_id');
	$reim_text_btn = get_field('reim_text_btn');
	$reim_text_btn_name = get_field('reim_text_btn_name');
	$frame_text = get_field('frame_text');
	$frame_text_id = get_field('f_section_id');

	$blue_callout = get_field('blue_callout');
		$blue_callout_id = get_field('blue_callout_id');
	$blue_callout_btn = get_field('blue_callout_btn');
	$blue_callout_btn_name = get_field('blue_callout_btn_name');
	$global_btn = get_field('global_btn');
	$global_btn_icon = get_field('global_btn_icon');
	$global_btn_name = get_field('global_btn_name');
	$main_nsclc_ref = get_field('ref_text');
	$main_page_url = get_field('nsclc_url');
	$clinical_url = get_field('nsclc_clinical_url');
	$programs_url = get_field('nsclc_program_url');
	$more_ctas = get_field('more_rep');
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
		<?php if (have_posts()) :?>
			<?php while (have_posts()) : the_post();?>
		  <div id="main-tab">
		   <?php
						if (have_rows('i_content_builder')) {
		   		while (have_rows('i_content_builder')) {
		      	the_row();
									include('partials/indications/'.get_row_layout().'.php');
		   		} 
		    } 
				?>
		  	<?php if($main_nsclc_ref) { ?>
						<div class="ref-text">
							<?php echo $main_nsclc_ref;?>
						</div>	
					<?php }?>	
		 		<?php if($blue_callout || $blue_callout_btn) { ?>
		 			<div class="callout" <?php if($blue_callout_id) echo ' id="'.$blue_callout_id.'"'?>>
		 				<?php if($blue_callout) echo '<h3>'.$blue_callout.'</h3>'?>
		 				<?php if($blue_callout_btn) echo '<a class="btn light-blue" href="'.$blue_callout_btn.'">'.$blue_callout_btn_name.'</a>'?>
		 			</div>	
		 		<?php } ?>	
		 		<?php get_template_part('partials/bottom-button');?>
		  </div>
		 <?php endwhile;?>
 	<?php endif;?>
	</div>
</div>
<?php get_footer(); ?>