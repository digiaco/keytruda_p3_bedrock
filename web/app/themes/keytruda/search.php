<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<h1>Search Results</h1>
		<p>
			Your search topic <strong><?php echo esc_html($s); ?></strong> returned the following articles:
		</p>
		<?php
			while (have_posts()) : the_post();
				get_template_part('loop');
			endwhile;
		?>

		<ul id="prev-next">
			<li id="prev"><?php next_posts_link('&laquo; Previous Entries') ?></li>
			<li id="next"><?php previous_posts_link('Newer Entries &raquo;'); ?></li>
		</ul>

	<?php else : ?>

		<h1>Search Results</h1>
		<p>
			Sorry, but your search term <strong><?php echo esc_html($s); ?></strong> returned <strong>0</strong> results.
		</p>

	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>