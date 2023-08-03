<?php /* Template Name: RCC Archive */?>
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
			<li class="active"><a href="<?php echo $main_page_url;?>"><?php pll_e('KEYTRUDA<sup>®</sup> + axitinib in RCC'); ?></a></li>
			<?php if($rcc_clinical_title || $rcc_desc || $keynotes) { ?>
				<li><a href="<?php echo $clinical_url;?>" ><?php pll_e('Clinical studies in RCC'); ?></a></li>
			<?php } ?> 
		</ul>
	    <div id="main-tab">
	    	<?php if($rcc_top_text) echo '<div class="intro">'.$rcc_top_text.'</div>';?>
	    	<?php if($rcc_indicate_list) { ?>
	    		<div class="indicate-list">
	    			<?php echo $rcc_indicate_list;?>
	    		</div>	
	    	<?php } ?>	
	    	<?php if($cancer_statement || $cancer_statement_title || $cancer_statement_url) { ?>
	    		<div class="statement">
	    			<div class="text-hold">
		    			<div class="text-wrap">
		    				<?php if($cancer_statement_title) echo '<p class="statement-title">'.$cancer_statement_title.'</p>';?>
		    				<?php if($cancer_statement) echo $cancer_statement;?>
		    				<?php if($cancer_statement_url) echo '<a href="'.$cancer_statement_url.'" class="btn">'.$cancer_statement_name.'</a>';?>
		    			</div>
	    			</div>
	    		</div>	
	    	<?php	
	    		}
	    	?>
	    	<?php if($explore_text) echo '<div class="explore">'.$explore_text.'</div>';?> 
    		<?php if ($list->have_posts()) : ?>
				<div class="posts-list">
					<div class="p-posts">
						<?php while ($list->have_posts()) : $list->the_post(); ?>
							<?php get_template_part('partials/loops/loop','hnscc');?>		
						<?php endwhile;?>	
					</div>
				</div>
			<?php endif;?>
			<?php wp_reset_postdata(); ?>
			<?php get_template_part('partials/top');?>
			<?php if($main_rcc_ref) { ?>
				<div class="ref-text">
					<?php echo $main_rcc_ref;?>
				</div>	
			<?php } ?>	
	    </div>
	</div>
</div>

<?php get_footer(); ?>