<?php /* Template Name: Patient profiles */?>
<?php global $post;?>
<?php get_header(); ?>
<?php 
	$main_top_bts = get_field('main_top_btns');
	$patient_cats = get_terms( array(
    'taxonomy' => 'nsclc-profiles-cat',
    'hide_empty' => true,
	));

	$cur_indication = get_field('p_indication');
	$ref = get_field('ref_text');
	$needed_terms = [];
	$i=0;
?>
<?php foreach($patient_cats as $el) { ?>
		<?php
			$list = new WP_Query(
				array(
					'posts_per_page' => -1,
					'post_type' => 'nsclc-profiles',
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy'  => 'nsclc-profiles-cat',
							'field'     => 'slug',
							'terms'     => $el->slug,
						),
						array(
							'taxonomy' => 'nsclc-profiles-ind',
							'field' => 'term_id',
							'terms' => $cur_indication
						),
						array(
							'taxonomy' => 'nsclc-profiles-ind',
							'operator' => 'NOT IN',
							'terms' => array(0)
						)
					)
				)
			);
			
			if ($list->have_posts()):
				while ($list->have_posts()) : $list->the_post();
					$i++;
					$available_terms = wp_get_post_terms($post->ID,'nsclc-profiles-cat');
					if( ($available_terms[0]->slug == $el->slug) && !in_array($available_terms[0]->slug,$needed_terms) ) {
						$needed_terms[$i]['slug'] = $available_terms[0]->slug;
						$needed_terms[$i]['name'] = $available_terms[0]->name;
					}
				endwhile;
			endif;	
			wp_reset_postdata();
	}		
	$unique_terms = array_unique($needed_terms, SORT_REGULAR);


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
		<div class="patients-content">

			<?php if (have_posts()) :?>
				<?php while (have_posts()) : the_post();?>
					<div class="content-section">
						<?php the_content();?>
					</div>
				<?php endwhile;?>	
				<?php wp_reset_postdata(); ?> 
			<?php endif;?>	

			<?php if($unique_terms) { ?>
				<div class="patients-nav">
					<?php foreach($unique_terms as $el) { ?>
						<a class="p-link" href="#<?php echo $el['slug'];?>"><span><?php echo $el['name'];?><sup>1</sup></span></a>
					<?php } ?>	
				</div>	
			<?php } ?>

			<?php foreach($unique_terms as $el) { ?>
					<?php
						$list = new WP_Query(array(
							'posts_per_page' => 4,
							'post_type' => 'nsclc-profiles',
							'tax_query'         => array(
								'relation' => 'AND',
									array(
									'taxonomy'  => 'nsclc-profiles-cat',
									'field'     => 'slug',
									'terms'     => $el['slug'],
									),
									array(
									'taxonomy' => 'nsclc-profiles-ind',
									'field' => 'term_id',
									'terms' => $cur_indication
									),
								)
							));
					?>

					<div class="patient-tabs-section" id="<?php echo $el['slug'];?>">
						<div class="tabs patient-tabs">

							<ul class="tabset">
								<?php $i = 0;?>
								<?php while ($list->have_posts()) : $list->the_post(); ?>
									<?php
										$i++;
										$name_desc = get_field('name_desc');
										$tabHref = "#".$el['slug']."-tab-". $i. "";
									?>
									<li>
										<a href="<?php echo $tabHref; ?>">
											<?php the_title(); ?>
											<sup>†</sup>
											<?php if($name_desc) { 
												echo '<span>'.$name_desc.'</span>'; 
											} ?>
										</a>
									</li>
								<?php endwhile?>
								<?php wp_reset_postdata(); ?> 
				   		</ul>

				      <?php $i = 0;?>
							<?php $currentID = get_the_ID(); ?>
							<?php if ($list->have_posts()) : ?>
								<?php while ($list->have_posts()) : $list->the_post();?>
									<?php 
									$i++;
									$tabId = "".$el['slug']."-tab-". $i. "";
									?>
									<div class="tab" id="<?php echo $tabId; ?>">
							     <?php 
							      $title = get_field('bg_i_info');
							      $sub_title = get_field('bg_i_info_sub');
							      $list_title = get_field('bg_i_list_title');
							      $list_items = get_field('bg_i_list_items');
							      $patient_promo_line = get_field('patient_promo_line');
										// Disable Promo Line 
										$patient_promo_line = '';
							     ?>
							     <div class="patient-meta">
							      <div class="bg-info">
							       <?php if(has_post_thumbnail()) { ?>
							        <div class="img-wrapper"><?php the_post_thumbnail('patient-img')?></div>
							        <?php if($title || $sub_title || $list_items) { ?>
							         <div class="text-wrapper">
							          <?php if($title) echo '<h2>'.$title.'</h2>';?>
							          <?php if($sub_title) echo '<h3>'.$sub_title.'</h3>';?>
							          <?php if($list_title) echo '<p class="sub-title">'.$list_title.'</p>'?>
							          <?php if($list_items) { ?>
							           <ul>
							            <?php foreach($list_items as $item) { ?>
							             <li><?php echo $item['item']?></li>
							            <?php } ?>
							           </ul> 
							          <?php } ?> 
							         </div> 
							        <?php } ?> 
							       <?php } ?> 
							      </div> 
							      <?php the_content();?>
							     </div>

							     <?php if($patient_promo_line) { ?>
							      <div class="promo-line">
							      	<h3><?php echo $patient_promo_line?></h3>
							      </div>  
							     <?php } ?>
									 
							     <?php  
							      $keynote_title = get_field('keynote_title', $currentID);
							      $keynote_btn = get_field('keynote_btn', $currentID);
							      $keynote_btn_name = get_field('keynote_btn_name', $currentID);
							     ?> 
							     <?php if($keynote_title || $keynote_btn) { ?>
							      <div class="keynote-promo">
							       <div class="wrap">
							        <?php if($keynote_title) echo '<h4>'.$keynote_title.'</h4>'?>
							        <?php if($keynote_btn || $keynote_btn_name) { ?>
							         <a target="_blank" class="btn light-blue" href="<?php echo $keynote_btn?>">
												<?php echo $keynote_btn_name?>
											 </a>
							        <?php } ?> 
							       </div>
							      </div>
							     <?php }  ?> 
							    </div> 
							  <?php endwhile;?>	
						  <?php endif;?>

						</div>
				 </div>
				 <?php wp_reset_postdata(); ?> 
				 
				<?php } ?>
				
		</div>

	<?php get_template_part('partials/top');?>

	<?php if($ref) { ?>
		<div class="ref-text">
			<?php echo $ref;?>
		</div>	
	<?php }?>	

  <?php get_template_part('partials/bottom-button');?>

	</div>
</div>
<?php get_footer(); ?>