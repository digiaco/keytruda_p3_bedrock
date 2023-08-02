<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<p><label for="s">Search for:</label></p>
		<p><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" /></p>
		<p><input type="submit" id="searchsubmit" value="Search" /></p>
	</fieldset>
</form>
