<?php /* Template Name: Merc Oncology */?>
<?php get_header(); ?>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="content-wrapper">
				<div class="entry-content">
					<?php the_content(); ?>
					<?php get_template_part('partials/history');?>
					<?php get_template_part('partials/promo')?>
					<?php get_template_part('partials/promo-grey');?>
				</div>
			</div>
		</article>
		<?php get_template_part('partials/top');?>
		<?php get_template_part('partials/ref');?>
	<?php
			endwhile;
		else:
			get_template_part('404');
		endif;
	?>
<?php get_footer(); ?>