<?php get_header(); ?>

	<?php 
		if (have_posts()) : 
			while (have_posts()) : the_post(); 
				get_template_part('loop');
			endwhile;
	?>

		<ul id="prev-next">
			<li id="prev"><?php next_posts_link('&laquo; Previous Entries') ?></li>
			<li id="next"><?php previous_posts_link('Newer Entries &raquo;'); ?></li>
		</ul>

	<?php 
		else : 
			get_template_part('404');
		endif;
	?>
<?php get_footer(); ?>