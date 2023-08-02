<?php /* Template Name: UC Archive */?>
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
			<li class="active"><a href="<?php echo $main_page_url;?>"><?php pll_e('KEYTRUDA<sup>®</sup> in UC'); ?></a></li>
			<?php if($uc_clinical_title || $uc_desc || $keynotes) { ?>
				<li><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in UC'); ?></a></li>
			<?php } ?>	
		</ul>
	    <div id="main-tab">
	    	<?php if($uc_top_text) echo '<div class="intro">'.$uc_top_text.'</div>';?>
	    	<?php if($uc_indicate_list) { ?>
	    		<div class="indicate-list">
	    			<?php echo $uc_indicate_list;?>
	    		</div>	
	    	<?php } ?>	
	    	<?php if($explore_text) echo '<div class="explore">'.$explore_text.'</div>';?> 
	    	<?php if($list) { ?>
	    		<?php if ($list->have_posts()) : ?>
					<div class="c-posts">
						<?php while ($list->have_posts()) : $list->the_post(); ?>
							<?php get_template_part('partials/loops/loop','nsclc');?>	
						<?php endwhile?>
					</div>
				<?php endif;?>
				<?php wp_reset_postdata(); ?>
	    	<?php } ?>	
			<?php get_template_part('partials/top');?>
			<?php if($main_uc_ref) { ?>
				<div class="ref-text">
					<?php echo $main_uc_ref;?>
				</div>	
			<?php } ?>	
	    </div>
	</div>
</div>

<?php get_footer(); ?>