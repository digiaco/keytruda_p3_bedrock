<?php
// ------------------------------------------
// Boilerplate WP setup of ours, fine to edit
// ------------------------------------------

// Generate Pretty Menu
function site_menu( $name = '', $depth = 1 ) {
	if( $name ) {
		$menu = wp_nav_menu( "container_class=menu&echo=0&menu=$name&depth=$depth" );
	} else {
		$menu = wp_nav_menu( "container_class=menu&echo=0&depth=$depth" );
	}

	/* Remove the wrapper and the poorly used title element */
	$menu = str_replace( '<div class="menu">', '', $menu );
	$menu = str_replace( '<ul>', '', $menu );
	$menu = str_replace( '</ul></div>', '', $menu );
	$menu = preg_replace( '/<ul id=\"(.*?)\" class=\"(.*?)\">/', '', $menu );
	//$menu = preg_replace( '/title=\"(.*?)\"/', '', $menu );
	echo $menu;
}

// Remove Generator
add_filter( 'the_generator', '__return_false' );

// Remove Gravity Forms TabIndex's
add_filter( 'gform_tabindex', '__return_false' );

// Editor Style
add_editor_style();

// Theme Support
function mr_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
add_action( 'after_setup_theme', 'mr_theme_setup' );

// Disable auto-linking to full size images
update_option( 'image_default_link_type', 'none' );

// Adds a class of hfeed to non-singular pages.
function mr_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'mr_body_classes' );

// Add a pingback url auto-discovery header for singularly identifiable articles.
function mr_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'mr_pingback_header' );

// Remove All Yoast HTML Comments
if ( defined( 'WPSEO_VERSION' ) ){
	add_action( 'get_header', function() {
		ob_start(
			function ( $o ) {
				return preg_replace( '/\n?<.*?yoast.*?>/mi', '', $o );
			}
		);
	});
	add_action( 'wp_head', function() {
		ob_end_flush();
	}, 999 );
}

// Remove WP features 99.99% of people don't need
function mr_customise_wp() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	add_filter( 'emoji_svg_url', '__return_false' );
	add_filter( 'show_recent_comments_widget_style', '__return_false', 99 );
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
}
add_action( 'init', 'mr_customise_wp' );

function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}