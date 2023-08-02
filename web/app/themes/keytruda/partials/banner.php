<?php
	if(is_post_type_archive('nsclc') || is_page_template('page-nsclc.php') || is_page_template('page-nsclc-clinical.php') || is_page_template('page-nsclc-program.php') || is_page_template('page-nsclc-patient.php') || is_page_template('page-study-results.php')) { 
		$banner = get_field('nsclc_banner','options');
		$banner_mob = get_field('nsclc_banner_mob','options');
		$banner_title =get_field('nsclc_banner_title','options');
	} elseif(is_post_type_archive('hnscc') || is_page_template('page-hnscc.php') || is_page_template('page-hnscc-clinical.php')){
		$banner = get_field('hnscc_banner','options');
		$banner_mob = get_field('hnscc_banner_mob','options');
		$banner_title =get_field('hnscc_banner_title','options');
	} elseif(is_post_type_archive('uc') || is_page_template('page-uc.php') || is_page_template('page-uc-clinical.php') ){ 
		$banner = get_field('uc_banner','options');
		$banner_mob = get_field('uc_banner_mob','options');
		$banner_title =get_field('uc_banner_title','options');
	} elseif(is_post_type_archive('rcc') || is_page_template('page-rcc.php') || is_page_template('page-rcc-clinical.php') ){ 
		$banner = get_field('rcc_banner','options');
		$banner_mob = get_field('rcc_banner_mob','options');
		$banner_title =get_field('rcc_banner_title','options');
	} elseif(is_post_type_archive('melanoma') || is_page_template('page-melanoma.php') || is_page_template('page-melanoma-clinical.php') ){ 
		$banner = get_field('mel_banner','options');
		$banner_mob = get_field('mel_banner_mob','options');
		$banner_title =get_field('mel_banner_title','options');
	} elseif(is_post_type_archive('gi') || is_page_template('page-gi.php') || is_page_template('page-gi-clinical.php') ) { 
		$banner = get_field('gi_banner','options');
		$banner_mob = get_field('gi_banner_mob','options');
		$banner_title = get_field('gi_banner_title','options');
		if(is_page_template('page-gi-clinical.php')) { 
			$add_banner = get_field('gi_banner_add','options');
			$add_banner_title = get_field('gi_cl_main_title','options');
			$add_banner_mob = get_field('gi_banner_add_mobile','options');
		}
	}
?> 


<?php
	if(isset($_POST['ref-link'])) { 
		$ref_link = $_POST['ref-link'];
	}
	else {
		$ref_link = '';
	}
?>
<?php if(is_post_type_archive('nsclc') || is_post_type_archive('hnscc') || is_post_type_archive('uc') || is_post_type_archive('rcc') || is_post_type_archive('melanoma') || is_post_type_archive('gi') || is_page_template('page-melanoma.php') || is_page_template('page-melanoma-clinical.php') || is_page_template('page-uc.php') || is_page_template('page-uc-clinical.php') || is_page_template('page-rcc.php') || is_page_template('page-rcc-clinical.php') || is_page_template('page-gi.php') || is_page_template('page-gi-clinical.php') || is_page_template('page-hnscc.php') || is_page_template('page-hnscc-clinical.php') || is_page_template('page-nsclc.php') || is_page_template('page-nsclc-clinical.php') || is_page_template('page-nsclc-program.php') || is_page_template('page-nsclc-patient.php') || is_page_template('page-study-results.php') ) {  ?>
	<?php if($banner) { ?>
		<div  class="banner <?php if($banner_mob || $add_banner_mob) echo ' mob';?> <?php if($add_banner) echo ' add-banner';?>">
			<div class="text-hold"> 
				<div class="content-wrapper">
					<?php if(!is_page_template('page-gi-clinical.php')) { ?>
						<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
					<?php } ?>
					<?php if(is_page_template('page-gi-clinical.php')) { ?>
						<?php if($add_banner_title) echo '<h1 class="esophageal-cancer">'.$add_banner_title.'</h1>';?>
					<?php } ?>
				</div>
			</div> 
			<?php if(!is_page_template('page-gi-clinical.php')) { ?>
				<?php echo wp_get_attachment_image( $banner, 'banner', $icon = false, array('alt'=> strip_tags($banner_title) ,'width'=>'1440','height'=>'350','class'=>'m-banner','tabindex'=>'0')); ?>
			<?php } ?>
			<?php if(is_page_template('page-gi-clinical.php')) { ?>
				<?php if($add_banner) echo wp_get_attachment_image( $add_banner, 'banner', $icon = false, array('alt'=>'Banner '.get_post_type( get_the_ID() ) ,'width'=>'1440','height'=>'350','class'=>'add-banner')); ?>
			<?php } ?>
			<?php if($banner_mob) echo wp_get_attachment_image( $banner_mob, 'mob-banner', $icon = false, array('alt'=>'' ,'class'=>'mob-img','role'=>'presentation') ); ?>
			<?php if(is_page_template('page-gi-clinical.php')) { ?>
				<?php if($add_banner_mob) echo wp_get_attachment_image( $add_banner_mob, 'mob-banner', $icon = false, array('alt'=>'','class'=>'add-banner-mob','role'=> 'presentation') ); ?>
			<?php } ?>
		</div>
	<?php } else { ?>
		<div class="banner no-img"></div>
	<?php } ?>	
<?php } elseif(is_singular('nsclc') || is_singular('hnscc') || is_singular('uc') || is_singular('rcc') || is_singular('melanoma') || is_singular('gi') ) { ?>
	<?php

		if(is_singular('hnscc') || is_singular('rcc') ){
			$banner_title = get_field('list_title');
		}
		elseif(is_singular('melanoma')){
			$banner_title = get_field('mel_title');	
		}
		elseif(is_singular('nsclc') || is_singular('uc')){
			$banner_title = get_field('custom_title');	
		}
		
		else{
			$banner_title = get_field('banner_title');	 
		}
		
		if(is_single(1424) || is_single(1428) ){
			$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=>'', 'tabindex'=>'-1','role'=>'presentation','aria-hidden'=>'true'));	
		}
		else{
			$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title), 'tabindex'=>'0'));		
		}
		
		$banner_mob = get_field('mob_banner',$post->ID);
		$back_link_color = get_field('back_link');
	?>
	<?php if(has_post_thumbnail() || $banner_mob) { ?>
		<div class="banner <?php if($banner_mob) echo ' mob';?>"> 
			<div class="btn-hold">
				<div class="content-wrapper">
					<a href="<?php echo $ref_link ? $ref_link : kt_archive_link()?>" class="back-link <?php echo $back_link_color;?> "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg> <?php pll_e('Back'); ?></a>
					
					<?php if($banner_title && is_singular('gi') ) { ?>
						<h1><?php echo $banner_title;?></h1>
					<?php } ?>	
				</div>
			</div>
			<?php echo $banner; ?>
			<?php if($banner_mob) echo wp_get_attachment_image( $banner_mob, 'mob-banner', $icon = false, array('alt'=> '', 'class'=>'mob-img','role'=> 'presentation','aria-hidden'=>'true') ); ?>
		</div>	
	<?php } else {  ?>
		<div class="banner">
			<div class="btn-hold">
				<div class="content-wrapper">
					<a href="<?php echo $ref_link ? $ref_link : kt_archive_link()?>" class="back-link <?php echo $back_link_color;?> "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg> <?php pll_e('Back'); ?></a>
				</div>
			</div>
			<?php echo '<img alt="" src="'.get_template_directory_uri().'/assets/img/default.jpg">'; ?>
		</div>
	<?php } ?>	
<?php } elseif(is_page_template('page-merc.php')) { ?>
	<?php
		$banner_title = get_field('banner_title');
		$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title),'tabindex'=>'0'));
		$banner_mob = get_field('mob_banner');
		
		$banner_desc = get_field('banner_desc');

		if($banner) { 
	?>
			<div class="banner page-banner <?php if($banner_mob) echo ' mob';?>">
				<?php if($banner_title || $banner_desc) { ?>
					<div class="banner-desc">
						<div class="content-wrapper">
							<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
							<?php if($banner_desc) echo '<div class="desc"><p>'.$banner_desc.'</p></div>';?>
						</div>	
					</div>	
				<?php } ?>	
				<?php echo $banner; ?>
				<?php if($banner_mob) echo wp_get_attachment_image( $banner_mob, 'mob-banner', $icon = false, array('alt'=>'', 'class'=>'mob-img','role'=>'presentation') ); ?>
			</div>	
		<?php } ?>
<?php } elseif(is_page_template('page-tumour.php')) { ?> 
	<?php if(has_post_thumbnail()) { ?>
		<div class="banner">
			<?php
				$banner_title = get_field('tumour_banner_title');
				$banner_desc = get_field('tumour_banner_desc');
				$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title),'tabindex'=>'0' ));
			?>
			<?php if($banner_title || $banner_desc) { ?>
				<div class="desc">
					<div class="content-wrapper">
						<?php if($banner_title || $banner_desc) echo '<h1>'.($banner_title ? '<strong>'.$banner_title.' </strong>' : '').$banner_desc.'</h1>';?>
					</div>
				</div>	
			<?php } ?>	
			<?php echo $banner; ?>
		</div>	
	<?php } ?>	
<?php } elseif(is_page_template('page-dosing.php') || is_page_template('page-main-resources.php') ) { ?>
	<?php if(has_post_thumbnail()) { ?>
		<div class="banner">
			<?php
				$banner_title = get_field('banner_title');
				$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title) ) );
			?>
			<?php if($banner_title || $banner_desc) { ?>
				<div class="desc">
					<div class="content-wrapper">
						<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
					</div>
				</div>	
			<?php } ?>	
			<?php echo $banner; ?>
		</div>	
	<?php } ?>
<?php } elseif(is_page() || is_single('keytruda_resources') || is_page_template('page-hcp-tools.php') || is_page_template('page-resources.php') || is_single('keytruda_clinical-studies')  ) { ?>
	<?php if(has_post_thumbnail()) { ?>

		<div class="banner page-banner">
			<?php
				$banner_title = get_field('banner_title');
				$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title),'tabindex'=>'0' ));
			?>
			<?php if($banner_title) { ?>
				<div class="banner-desc">
					<div class="content-wrapper">
						<?php if ( is_page() && $post->post_parent ) { ?>
							<a href="<?php echo get_permalink($post->post_parent)?>" class="back-link white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg> <?php pll_e('Back'); ?></a>
						<?php } ?>	
						<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
					</div>
				</div>	
			<?php } ?>	
			<?php echo $banner; ?>
		</div>	
	<?php } ?>	
<?php } elseif(is_page_template('page-dosing-faq.php')  ) { ?>
	<?php if(has_post_thumbnail()) { ?>

		<div class="banner page-banner">
			<?php
				$banner_title = get_field('banner_title');
				$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title),'tabindex'=>'0' ));
			?>
			<?php if($banner_title) { ?>
				<div class="banner-desc">
					<div class="content-wrapper">
						<?php if ( is_page() && $post->post_parent ) { ?>
							<a href="<?php echo get_permalink($post->post_parent)?>" class="back-link white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg> <?php pll_e('Back'); ?></a>
						<?php } ?>	
						<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
					</div>
				</div>	
			<?php } ?>	
			<?php echo $banner; ?>
		</div>	
	<?php } ?>
<?php } elseif(is_page_template('page-ae-management.php')) { ?>
	<?php if(has_post_thumbnail()) { ?>
		<div class="banner">
			<?php
				$banner_title = get_field('banner_title');
				$banner = get_the_post_thumbnail($post->ID,'banner',array('alt'=> strip_tags($banner_title) ) );
				$banner_desc = get_field('banner_desc');
			?>
			<?php if($banner_title || $banner_desc) { ?>
				<div class="desc">
					<div class="content-wrapper">
						<?php if($banner_title) echo '<h1>'.$banner_title.'</h1>';?>
						<?php if($banner_desc) echo '<div class="desc"><p>'.$banner_desc.'</p></div>';?>
					</div>
				</div>	
			<?php } ?>	
			<?php echo $banner; ?>
		</div>	
	<?php } ?>
<?php } ?>	