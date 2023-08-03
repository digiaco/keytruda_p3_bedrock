<?php /*Template Name: Resources HCP Tools */ ?>
<?php get_header(); ?>
<?php
	$page_ref = get_field('ref_text');
	$melanoma_list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'melanoma',
		'order' => 'DESC',
	));
	$melanoma_list_desc = get_field('melanoma_list_desc');
	$uc_list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'uc',
		'order' => 'DESC',
	));
	$rcc_list = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => 'rcc',
		'order' => 'DESC',
	));
	$nsclc_cats = get_terms( 'nsclc_category', array(
    	'hide_empty' => true,
    	'order' => 'DESC',
	));
	$uc_desc = get_field('uc_dsc');
	$rcc_desc = get_field('rcc_dsc');
	$colorectal = get_field('c_c');
	$eso_content = get_field('eso_content');
	$tnbc = get_field('tnbc_content');
	$mel_list = get_field('mel_list');
?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">
					<?php the_content();?>
					<div class="accordion">
						<ul aria-label="Resources" class="accordion-controls">
							<?php if($colorectal) { ?>
								<li>
									<button aria-controls="cc" aria-expanded="false" id="accordion-control-cc"><?php pll_e('Colorectal cancer'); ?></button>
									<div aria-hidden="true" style="display:none" class="acc-block" id="cc">
										<div class="colorectal-rep">
											<?php foreach($colorectal as $el) { ?>
												<div class="item">
													<?php $img = $el['img'];?>
													<?php $desc = $el['desc'];?>
													<?php $btn = $el['btn'];?>
													<?php $btn_add = $el['btn_add'];?>
													<?php $btn_name = $el['btn_name'];?>
													<?php $btn_add_name = $el['btn_add_name'];?>
													<?php if($img) echo wp_get_attachment_image( $img, $size = 'full', $icon = false, array('alt'=>'overview image') ); ?>
													<div class="hold">
														<?php if($desc) echo '<p>'.$desc.'</p>'?>
														<?php if($btn) echo '<a class="btn" href="'.$btn.'">'.$btn_name.'</a>';?>
														<?php if($btn_add) echo '<a class="btn" href="'.$btn_add.'">'.$btn_add_name.'</a>';?>
													</div>	
												</div>	
											<?php } ?>	
										</div>
									</div>	
								</li>	
							<?php } ?>
							<?php if($eso_content) { ?>
								<li>
									<button aria-controls="eso" aria-expanded="false" id="accordion-control-eso"><?php pll_e('Esophageal Cancer'); ?></button>
									<div aria-hidden="true" style="display:none" class="acc-block" id="eso">
										<div class="i-list">
										<?php foreach($eso_content as $el) { ?>
											<?php 
												$content_type = $el['content_type'];
												$title = $el['title'];
												$desc = $el['desc'];
												$video_type = $el['video_type'];
												$th_img = $el['th_img'];
												if($content_type == 'file') {
													$url = $el['file'];
												} elseif($content_type == 'video'){
													if($video_type == 'v-file') {
														$url = $el['video_file'];
													}
													else {
														$url = $el['video_embed'];
													}
												} else {
													$url = $el['default_url'];
												}
											?>
											<div class="item">
												<?php if($th_img) { ?>
													<div class="img-wrapper <?php if($content_type == 'video') echo ' with-video';?>">
														<?php echo wp_get_attachment_image( $th_img, $size = 'res-thumb', $icon = false, array('alt'=>'') ); ?>
														<?php if($content_type == 'video') { ?>
															<a data-fancybox href="<?php echo $url?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 22v-20l18 10-18 10z"/></svg></a>
														<?php } ?>
													</div>
												<?php } ?>
												<div class="text-wrapper">
													<?php if($title) echo '<h3>'.$title.'</h3>';?>
													<?php if($desc) echo $desc;?>
													<?php if($url) { ?>
														<a <?php if($content_type == 'video') echo ' data-fancybox'?> href="<?php echo $url?>" class="btn"><?php echo $el['button_name']?></a>
													<?php } ?>	
												</div>	
											</div>
										<?php } ?>	
									</div>
									</div>	
								</li>	
							<?php } ?>
							<li>
								<button aria-controls="hnscc" aria-expanded="false" id="accordion-control-hnscc"><?php pll_e('Head and neck squamous cell carcinoma'); ?></button>
								<div aria-hidden="true" style="display:none" class="acc-block" id="hnscc">
									<?php $hnscc_desc = get_field('add_hnscc_desc');?>
									<?php if($hnscc_desc) echo '<div class="m-desc">'.$hnscc_desc.'</div>';?>
									<?php 
							    		$hnscc_cats = get_terms( 'hnscc_category', array(
									    	'hide_empty' => true,
									    	'order' => 'DESC',
										));
									if($hnscc_cats) { 
						    		?>
							    		<div class="posts-list">
							    			<?php foreach($hnscc_cats as $el ) { ?>
							    				<?php 
							    					$custom_cat_title = get_field('res_cat_title','hnscc_category_'.$el->term_id);
							    					
							    				?>
								    			<div class="el">
								    				<p class="cat-title">
								    					
								    					<?php if($custom_cat_title) { ?>
								    						<?php echo $custom_cat_title;?>
								    					<?php } else {  ?>
								    						<?php echo $el->name.' HNSCC';?>	
								    					<?php } ?>	
								    				</p>
								    				<?php
								    					$list = new WP_Query(array(
															'posts_per_page' => -1,
															'post_type' => 'hnscc',
															'order' => 'DESC',
															'tax_query' => array(
                    array(
                        'taxonomy' => 'hnscc_category',
                        'field' => 'term_id',
                        'terms' => $el->term_id,
                        'order' => 'DESC',
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
							    	<?php 
							    		$trials = get_field('h_trials');
							    		if($trials) { 
							    	?>
							    		<div class="colorectal-rep">
								    		<?php foreach($trials as $el) { ?>
												<div class="item">
													<?php $img = $el['img'];?>
													<?php $desc = $el['desc'];?>
													<?php $btn = $el['btn'];?>
													<?php $btn_name = $el['btn_name'];?>
													<?php if($img) echo wp_get_attachment_image( $img, $size = 'full', $icon = false, array('alt'=>'overview image') ); ?>
													<div class="hold">
														<?php if($desc) echo '<p>'.$desc.'</p>'?>
														<?php if($btn) echo '<a class="btn" href="'.$btn.'">'.$btn_name.'</a>';?>
													</div>	
												</div>	
											<?php } ?>
										</div>
							    	<?php } ?>
								</div>	
							</li>
							<li>
								<button aria-controls="melanoma" aria-expanded="false" id="accordion-control-melanoma"><?php pll_e('Melanoma'); ?></button>
								<div aria-hidden="true" style="display:none" class="acc-block" id="melanoma">
									<?php if($mel_list) { ?>
										<div class="i-list">
												<?php foreach($mel_list as $el) { ?>
													<?php 
														$content_type = $el['content_type'];
														$title = $el['title'];
														$desc = $el['desc'];
														$th_img = $el['th_img'];
														if($content_type == 'file') {
															$url = $el['file'];
														} else {
															$url = $el['default_url'];
														}
													?>
													<div class="item">
														<?php if($th_img) { ?>
															<div class="img-wrapper">
																<?php echo wp_get_attachment_image( $th_img, $size = 'res-thumb', $icon = false, array('alt'=>'') ); ?>
															</div>
														<?php } ?>
														<div class="text-wrapper">
															<?php if($title) echo '<h3>'.$title.'</h3>';?>
															<?php if($desc) echo $desc;?>
															<?php if($url) { ?>
																<a href="<?php echo $url?>" class="btn"><?php echo $el['button_name']?></a>
															<?php } ?>	
														</div>	
													</div>
												<?php } ?>
										</div>
									<?php } ?>
									<?php if($melanoma_list || $melanoma_list_desc) { ?>
							    		<?php if($melanoma_list_desc) echo '<div class="m-desc">'.$melanoma_list_desc.'</div>';?>
							    		<?php if ($melanoma_list->have_posts()) : ?>
											<div class="posts-list melanoma-posts">
												<div class="p-posts">
													<?php while ($melanoma_list->have_posts()) : $melanoma_list->the_post(); ?>
														<?php get_template_part('partials/loops/loop','melanoma');?>	
													<?php endwhile?>
												</div>
											</div>
										<?php endif;?>
										<?php wp_reset_postdata(); ?>
							    	<?php } ?>
								</div>	
							</li>
							<?php if($nsclc_cats) { ?> 
							<li>
								<button aria-controls="nscl" aria-expanded="false" id="accordion-control-nscl"><?php pll_e('Non-small cell lung cancer'); ?></button>
								<div aria-hidden="true" style="display:none" class="acc-block" id="nscl">
									<?php $nsclc_desc = get_field('nsclc_desc');?>
									<?php if($nsclc_desc) echo '<div class="m-desc">'.$nsclc_desc.'</div>';?>
									<div class="tabs" id="nsclc-tabs">
										<ul class="tabset inside">
											<?php foreach($nsclc_cats as $cat) { ?>
												<li><a href="#<?php echo $cat->slug;?>"><?php echo $cat->name;?></a></li>		
											<?php } ?>	
										</ul>	
										<?php foreach($nsclc_cats as $cat) { ?>
											<div id="<?php echo $cat->slug;?>">
												<?php
													$list = new WP_Query(array( 
														'posts_per_page' => -1,
														'post_type' => 'nsclc',
														'order' => 'ASC', 
														'tax_query' => array(
										                    array(
										                        'taxonomy' => 'nsclc_category',
										                        'field' => 'term_id',
										                        'terms' => $cat->term_id,
										                    )
										                )
										        	));
												?>
												<?php if ($list->have_posts()) : ?>
													<div class="c-posts">
														<?php while ($list->have_posts()) : $list->the_post(); ?>
															<?php get_template_part('partials/loops/loop','nsclc');?>	
														<?php endwhile?>
													</div>
												<?php endif;?>
											</div>	
										<?php } ?>	
									</div>	
								</div>	
							</li>	
							<?php } ?>
							<li>
								<button aria-controls="rcc" aria-expanded="false" id="accordion-control-rcc"><?php pll_e('Renal cell carcinoma'); ?></button>
								<div aria-hidden="true" style="display:none" class="acc-block" id="rcc">
									<?php if($rcc_desc) echo '<div class="m-desc">'.$rcc_desc.'</div>';?>
									<?php if($rcc_list) { ?>
							    		<?php if ($rcc_list->have_posts()) : ?>
											<div class="posts-list">
												<div class="p-posts">
													<?php while ($rcc_list->have_posts()) : $rcc_list->the_post(); ?>
														<?php get_template_part('partials/loops/loop','hnscc');?>		
													<?php endwhile;?>	
												</div>
											</div>
										<?php endif;?>
										<?php wp_reset_postdata(); ?>
							    	<?php } ?>
							    	<?php $rcc_b_title = get_field('rcc_b_title'); ?>
							    	<?php $rcc_b_url = get_field('rcc_b_url'); ?>
							    	<?php $rcc_b_name = get_field('rcc_b_name'); ?>
							    	<?php if($rcc_b_title || $rcc_b_url) { ?>
								    	<div class="bottom-button">
									  		<?php if($rcc_b_title) echo '<h4>'.$rcc_b_title.'</h4>';?>
									  		<a class="btn" href="<?php echo $rcc_b_url;?>"><?php echo $rcc_b_name;?></a>
										</div>
									<?php } ?>
								</div>	
							</li>
							<?php if($tnbc) { ?>
								<li>
									<button aria-controls="tnbc" aria-expanded="false" id="accordion-control-tnbc"><?php pll_e('Triple-negative breast cancer'); ?></button>
									<div aria-hidden="true" style="display:none" class="acc-block" id="tnbc">
										<div class="i-list">
											<?php foreach($tnbc as $el) { ?>
												<?php 
													$content_type = $el['content_type'];
													$title = $el['title'];
													$desc = $el['desc'];
													$th_img = $el['th_img'];
													if($content_type == 'file') {
														$url = $el['file'];
													} else {
														$url = $el['default_url'];
													}
												?>
												<div class="item">
													<?php if($th_img) { ?>
														<div class="img-wrapper">
															<?php echo wp_get_attachment_image( $th_img, $size = 'res-thumb', $icon = false, array('alt'=>'') ); ?>
														</div>
													<?php } ?>
													<div class="text-wrapper">
														<?php if($title) echo '<h3>'.$title.'</h3>';?>
														<?php if($desc) echo $desc;?>
														<?php if($url) { ?>
															<a href="<?php echo $url?>" class="btn"><?php echo $el['button_name']?></a>
														<?php } ?>	
													</div>	
												</div>
											<?php } ?>
										</div>
									</div>	
								</li>	
							<?php } ?>
							<li>
								<button aria-controls="u-car" aria-expanded="false" id="accordion-control-u-car"><?php pll_e('Urothelial carcinoma'); ?></button>
								<div aria-hidden="true" style="display:none" class="acc-block" id="u-car">
									<?php if($uc_desc) echo '<div class="m-desc">'.$uc_desc.'</div>';?>
									<?php if($uc_list) { ?>
							    		<?php if ($uc_list->have_posts()) : ?>
											<div class="c-posts">
												<?php while ($uc_list->have_posts()) : $uc_list->the_post(); ?>
													<?php get_template_part('partials/loops/loop','nsclc');?>	
												<?php endwhile?>
											</div>
										<?php endif;?>
										<?php wp_reset_postdata(); ?>
				    	<?php } ?> 	
								</div>	
							</li>
						</ul>	
					</div>	
				</div>
				<?php get_template_part('partials/top');?>
   	<?php if($page_ref) { ?>
					<div class="ref-text">
						<?php echo $page_ref;?>
					</div>	
				<?php } ?>
			</div>
		</article>

	<?php
			endwhile;
		else:
			get_template_part('404');
		endif;
	?>
<?php get_footer(); ?>