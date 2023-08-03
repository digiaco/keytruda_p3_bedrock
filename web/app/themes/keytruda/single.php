<?php get_header(); ?>

<div class="content-wrapper">
	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
		<article <?php post_class(); ?>>
			<div class="entry-content">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</article>

	<?php
			endwhile;
		else:
			get_template_part('404');
		endif;
	?>
</div>
<?php get_footer(); ?>