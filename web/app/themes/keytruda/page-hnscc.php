<?php /* Template Name: HNSCC Archive */?>
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
			<li class="active"><a href="<?php echo $main_page_url?>"><?php pll_e('KEYTRUDA<sup>®</sup> in HNSCC'); ?></a></li>
			<?php if($hnscc_clinical_title || $hnscc_desc || $keynotes || $map_section) { ?> 
				<li><a href="<?php echo $clinical_url;?>"><?php pll_e('Clinical studies in HNSCC'); ?></a></li>
			<?php } ?>
		</ul>
	    <div id="main-tab">
	    	<?php if($hnscc_top_text) echo '<div class="intro">'.$hnscc_top_text.'</div>';?>
	    	<?php if($hnscc_indicate_list) { ?>
	    		<div class="indicate-list">
	    			<?php echo $hnscc_indicate_list;?>
	    		</div>	
	    	<?php } ?>	
	    	<?php if($explore_text) echo '<div class="explore">'.$explore_text.'</div>';?> 
	    	<?php 
	    		$hnscc_cats = get_terms( 'hnscc_category', array(
			    	'hide_empty' => true,
				));
			if($hnscc_cats) { 
    		?>
	    		<div class="posts-list">
	    			<?php foreach($hnscc_cats as $el ) { ?>
		    			<div class="el">
		    				<?php if(ICL_LANGUAGE_CODE=='en'): ?>
		    					<p class="cat-title"><?php echo $el->name.' HNSCC'?></p>
		    				<?php else: ?>
		    					<p class="cat-title"><?php echo $el->name?></p>
		    				<?php endif;?>	
		    				
		    				<?php
		    					$list = new WP_Query(array(
									'posts_per_page' => -1,
									'post_type' => 'hnscc',
									'order' => 'DESC',
									'tax_query' => array(
					                    array(
					                        'taxonomy' => 'hnscc_category', 
					                        'field' => 'term_id',
					                        'order' => 'DESC',
					                        'terms' => $el->term_id, 
					                    )
				                	)
				        		));
				        		if($list) { 
		    				?>
		    					<div class="p-posts">
		    						<?php while ($list->have_posts()) : $list->the_post(); ?>
		    							<?php get_template_part('partials/loops/loop','hnscc');?>		
		    						<?php endwhile;?>	
		    					</div>
		    				<?php } wp_reset_postdata();?>
		    			</div>	
	    			<?php } ?>
	    		</div>	
	    	<?php } ?>
	    	<?php if($map_section_main || $map_section_url_main) { ?>
	      		<div class="map-section blue">
	      			<div class="text-wrapper">
	      				<?php if($map_section_main) echo '<p>'.$map_section_main.'</p>'?>
	      				<?php if($map_section_url_main) echo '<a class="btn" href="'.$map_section_url_main.'">'.$map_section_btn_main.'</a>';?>
	      			</div>
	      			<div class="map-placer">
	      				<img style="max-width:503px;" src="<?php echo get_template_directory_uri()?>/assets/img/blue-map.png" alt="nearest testing centre">
	      				<img src="<?php echo get_template_directory_uri()?>/assets/img/blue-map-mobile.png" role="presentation" class="mobile" alt="">
	      			</div>	
	      		</div>	
	      	<?php } ?>	
	      	<?php
	      		if($handbook_img || $handbook_title || $handbook_btn_url) { 
	      	?>
	      		<div class="handbook">
	      			<?php if($handbook_img) echo wp_get_attachment_image( $handbook_img, 'handbook-img', $icon = false, array('alt'=>$handbook_title) ); ?>
	      			<?php if($handbook_title || $handbook_btn_url) { ?>
      					<div class="text-wrapper">
      						<?php if($handbook_title) echo '<p>'.$handbook_title.'</p>';?>
      						<?php if($handbook_btn_url) echo '<a class="btn green" href="'.$handbook_btn_url.'">'.$handbook_btn_name.'</a>';?>
      					</div>	
	      			<?php } ?>	
	      		</div>	
     	 	<?php } ?>
			<?php get_template_part('partials/top');?>
			<?php if($main_hnscc_ref) { ?>
				<div class="ref-text">
					<?php echo $main_hnscc_ref;?>
				</div>	
			<?php } ?>	
	    </div>
	</div>
</div>

<?php get_footer(); ?>