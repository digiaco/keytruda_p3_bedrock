<?php /* Template Name: Melanoma Archive */?>
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
	$offers_btn_type = get_field('offers_btn_type','options');
	if($offers_btn_type == 'url'){
		$offers_btn = get_field('offers_btn','options');
	} else{
		$offers_btn = get_field('offers_btn_file','options');
	}
	
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
			<li class="active"><a href="<?php echo $main_page_url?>"><?php pll_e('KEYTRUDA<sup>®</sup> in melanoma'); ?></a></li>
			<?php if($mel_clinical_title || $mel_desc || $keynotes) { ?>
			<li><a href="<?php echo $clinical_url;?>"><?php pll_e('Clinical studies in melanoma'); ?></a></li>	
			<?php } ?>
		</ul>
	    <div id="main-tab"> 
	    	<?php if($mel_top_text) echo '<div class="intro">'.$mel_top_text.'</div>';?>
	    	<?php if($offers_title || $offers_desc || $offers_btn || $offers_btn_bottom_text) { ?>
	    		<div class="offers">
	    			<div class="text-wrapper">
	    				<?php if($offers_title) echo '<h2>'.$offers_title.'</h2>';?> 
	    				<?php if($offers_desc) echo '<p>'.$offers_desc.'</p>';?>
	    				<?php if($offers_btn) echo '<div><a class="btn" href="'.$offers_btn.'">'.$offers_btn_name.'</a></div>'?>
	    				<?php if($offers_btn_bottom_text) echo '<span class="txt">'.$offers_btn_bottom_text.'</span>';?>
	    			</div>
	    			<?php if($offers_img ) echo wp_get_attachment_image( $offers_img , 'offers-image', $icon = false, array('alt'=>$offers_title)); ?>
	    		</div>	
	    	<?php } ?>
	    	<?php if($add_desc) echo '<div class="add-desc">'.$add_desc.'</div>';?>	
	    	<?php if($mel_indicate_list) { ?>
	    		<div class="indicate-list">
	    			<?php echo $mel_indicate_list;?>
	    		</div>	
	    	<?php } ?>	
	    	<?php if($explore_text) echo '<div class="explore">'.$explore_text.'</div>';?> 
	    	<?php if($list) { ?>
	    		<?php if ($list->have_posts()) : ?>
					<div class="posts-list">
						<div class="p-posts">
							<?php while ($list->have_posts()) : $list->the_post(); ?>
								<?php get_template_part('partials/loops/loop','melanoma');?>	
							<?php endwhile?>
						</div>
					</div>
				<?php endif;?>
				<?php wp_reset_postdata(); ?>
	    	<?php } ?>	
			<?php get_template_part('partials/top');?>
			<?php if($mel_ref) { ?>
				<div class="ref-text">
					<?php echo $mel_ref;?>
				</div>	
			<?php } ?>	
	    </div>
	</div> 
</div>

<?php get_footer(); ?>