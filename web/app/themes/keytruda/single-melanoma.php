<?php get_header(); ?>
<?php
	$q_title = get_field('q_title');
	$q_person = get_field('q_person');
	$q_img = get_field('q_img');
	$promo = get_field('mel_promo_line');
?>
<?php $custom_title = get_field('custom_title');?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="content-wrapper">
				<div class="entry-content">
					<div class="entry-wrapper">
						<h1 class="entry-title"><?php echo ($custom_title ? $custom_title : get_the_title())?></h1>
						<?php
							$patient_name = get_field('patient_name');
							$patient_info = get_field('patient_list');
						?>
						<div class="patients-holder">
							<?php if($patient_name || $patient_list) { ?>
								<div class="patient-info">
									<?php if($patient_name) echo '<h2>'.$patient_name.'</h2>';?>
									<?php if($patient_info) { ?>
										<ul>
											<?php foreach($patient_info as $el) { ?>
												<li><?php echo $el['info'];?></li>
											<?php } ?>	
										</ul>	
									<?php } ?>	
								</div>	
							<?php } ?>	
							<?php if($q_title || $q_person || $q_img ) { ?>
								<div class="quote">
									<div class="wrap">
										<?php if($q_title) echo '<p class="title"><strong>'.$q_title.'</strong></p>';?>
										<?php if($q_person) echo '<div class="person">'.$q_person.'</div>';?>
									</div>
									<?php /*
									<?php if($q_img) echo wp_get_attachment_image( $q_img, 'q-photo', $icon = false, array('alt'=>'patient photo','class'=>'img-quote') );?>
									*/?>
								</div>	
							<?php } ?>	
						</div>
						<?php the_content(); ?>
						<?php if($promo) echo '<div class="promo p-line"><div class="wrap">'.$promo.'</div></div>'?>
					</div>
					<?php get_template_part('partials/post-nav');?>
				</div>
			</div>
		</article>
		<?php get_template_part('partials/top');?>
		<?php get_template_part('partials/ref');?>
	<?php endwhile; else: ?>
		<?php get_template_part('404'); ?>
	<?php endif; ?>
<?php get_footer(); ?>