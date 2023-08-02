<?php
// ------------------------------------------
// Theme specific functions
// ------------------------------------------

if(!function_exists('pll_e') && !function_exists('pll__')){
	function pll_e( $string ) {
		echo pll__( $string ); // phpcs:ignore
	}
	function pll__( $string ) {
		return is_scalar( $string ) ? __( $string, 'pll_string' ) : $string; // PHPCS:ignore WordPress.WP.I18n
	}

}

// Add Template Column to Pages Listing in WordPress Admin
function custom_template_column($columns) {
	$columns['template'] = 'Template';
	return $columns;
}
add_filter('manage_page_posts_columns', 'custom_template_column');

function custom_template_value($column_name, $post_id) {
	if ($column_name === 'template') {
		$template_name = get_post_meta($post_id, '_wp_page_template', true);
		echo $template_name;
	}
}
add_action('manage_page_posts_custom_column', 'custom_template_value', 10, 2);

function getDecodedString($string = ''){
	if(!isset($string) || empty($string)){
		return '';
	}
	$decodedString = utf8_decode(urldecode($string));

	$properlyEncodedString = preg_replace_callback('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', function ($matches) {
	    $table = array(
	        'agrave' => 'à', 'aacute' => 'á', 'acirc' => 'â', 'atilde' => 'ã', 'auml' => 'ä',
	        'egrave' => 'è', 'eacute' => 'é', 'ecirc' => 'ê', 'euml' => 'ë',
	        'igrave' => 'ì', 'iacute' => 'í', 'icirc' => 'î', 'iuml' => 'ï',
	        'ograve' => 'ò', 'oacute' => 'ó', 'ocirc' => 'ô', 'otilde' => 'õ', 'ouml' => 'ö',
	        'ugrave' => 'ù', 'uacute' => 'ú', 'ucirc' => 'û', 'uuml' => 'ü',
	        'ccedil' => 'ç',
	        'oslash' => 'ø',
	        'aelig' => 'æ',
	        'oslash' => 'ø',
	        'aring' => 'å',
	        'oelig' => 'œ',
	        'szlig' => 'ß',
	    );
	    return mb_convert_encoding($table[strtolower($matches[1]) . $matches[2]], "UTF-8");
	}, $decodedString);

	$properlyEncodedString = str_replace(
    array('Ã¨', 'â', 'â', '�', '�'),
    array('è', "'", "'", '’', 'œ'),
    $properlyEncodedString
	);

	return $properlyEncodedString;
}

function set_polylang_url_modifications() {
	$useLocal = getenv('USE_LOCAL');
	$wpDomainEN = getenv('WP_DOMAIN_EN');
	$wpDomainFR = getenv('WP_DOMAIN_FR');
	$pllOptions = get_option('polylang');
	if(isset($pllOptions) && !empty($pllOptions) && is_array($pllOptions)){
		if(isset($wpDomainEN) && !empty($wpDomainEN) && isset($wpDomainFR) && !empty($wpDomainFR) ){
			if (isset($useLocal) && $useLocal == 'true') {
				// $pllOptions['force_lang'] = 1;
				// $pllOptions['hide_default'] = 1;
				// $pllOptions['rewrite'] = 1;
				$pllOptions['domains'] = array(
					'en' => $wpDomainEN.'.loc',
					'fr' => $wpDomainFR.'.loc'
				);
			} else {
				// $pllOptions['force_lang'] = 3;
				// $pllOptions['hide_default'] = 1;
				// $pllOptions['rewrite'] = 1;
				$pllOptions['domains'] = array(
					'en' => $wpDomainEN,
					'fr' => $wpDomainFR
				);
			}
		}
	}

	if(isset($pllOptions) && !empty($pllOptions) && is_array($pllOptions)){
		update_option('polylang', $pllOptions);
	}
}

add_action('after_setup_theme', 'set_polylang_url_modifications');

// Image Sizes
set_post_thumbnail_size(150, 150, true);
add_image_size('overview-img', 474, 732);
add_image_size('overview-hnscc', 700, 9999);
add_image_size('post-nav', 414, 414, true);
add_image_size('banner', 2880, 700);

// Content Width
if (!isset($content_width)) $content_width = 500;

// Menus
register_nav_menus(array(
	'primary' => 'Main Menu',
	'secondary' => 'Top Menu',
	'footer' => 'Footer Menu'
));

// Widgets
add_action('widgets_init', 'kt_widgets_init');
function kt_widgets_init()
{
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

// Core Enqueues
function kt_core_scripts_styles()
{
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('jquery-core');

	// Custom files for each min js
	wp_enqueue_script('dotdotdot.min.js', get_template_directory_uri() . '/assets/js/dotdotdot.min.js', array('jquery-core'));
	wp_enqueue_script('tabslet.min.js', get_template_directory_uri() . '/assets/js/tabslet.min.js', array('jquery-core'));
	wp_enqueue_script('popups.min.js', get_template_directory_uri() . '/assets/js/popups.min.js', array('jquery-core'));
	wp_enqueue_script('simple-bar.min.js', get_template_directory_uri() . '/assets/js/simple-bar.min.js', array('jquery-core'));

	wp_enqueue_script(
		'jquery.main.js',
		get_template_directory_uri() . '/assets/js/jquery.main.js',
		array('jquery-core', 'dotdotdot.min.js', 'tabslet.min.js', 'popups.min.js', 'simple-bar.min.js'),
		null,
		false
	);

	wp_enqueue_style('kt-style', get_stylesheet_uri());
	wp_enqueue_style('custom-styles', get_template_directory_uri() . '/assets/css/styles.css');

	wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/css/custom.css');
}
add_action('wp_enqueue_scripts', 'kt_core_scripts_styles');

// Custom WP Head
function kt_head()
{
?>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="application-name" content="<?php bloginfo('name'); ?>" />
	<meta name="msapplication-TileColor" content="#ffffff" />
	<?php
}
add_action('wp_head', 'kt_head');

// Advanced Custom Fields Options Panels
if (function_exists('acf_add_options_page')) {
	// acf_add_options_page();
	acf_add_options_page('Theme Options');
}


/* Main Menu Icons */

add_filter('wp_nav_menu_objects', 'kt_wp_nav_menu_icons', 10, 2);

function kt_wp_nav_menu_icons($items, $args)
{
	foreach ($items as &$item) {
		$icon = get_field('icon', $item);
		$icon_img = wp_get_attachment_image($icon, $size = 'icon', $icon = false, array('alt' => $item->title, 'role' => 'presentation'));

		if ($icon_img) {

			$item->title = '<span class="img-wrapper">' . $icon_img . '</span>' . $item->title;
		}
	}
	return $items;
}

/* Post nav image*/
function kt_nav_img($post_id)
{
	$nav_img = get_field('navigation_image', $post_id);
	if ($nav_img) {
		$img = wp_get_attachment_image_src($nav_img, 'post-nav', $icon = false);
		return $img[0];
	} elseif (has_post_thumbnail($post_id)) {
		$img = get_the_post_thumbnail_url($post_id, 'post-nav');
		return $img;
	}
}


/* History List Styles */
add_action('wp_head', 'kt_history_list_color_styles', 100);

function kt_history_list_color_styles()
{
	$history_list = get_field('history');
	if ($history_list) {
		$i = 0;
		foreach ($history_list as $el) {
			$i++;
			$el_color = $el['el_color'];
			if ($el_color) { ?>
				<style>
					.history-list .el.item-<?php echo $i; ?>span.year {
						background: <?php echo $el_color; ?>;
					}

					.history-list .el.item-<?php echo $i ?>h3 {
						color: <?php echo $el_color; ?>;
					}

					.history-list .el.item-<?php echo $i ?>span.year:after {
						background: <?php echo $el_color; ?>;
					}

					.history-list .el.item-<?php echo $i ?>ul li:before {
						background: <?php echo $el_color; ?>;
					}
				</style>
<?php }
		}
	}
}
/*
function add_rating_data_to_js() {
  $rating_data = array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'rating_count' => get_field('vote_count','options'),
    'average_rating' => get_field('average_rating','options')
  );
  wp_localize_script('jquery.main.js', 'ratingData', $rating_data);
}
add_action('wp_enqueue_scripts', 'add_rating_data_to_js');

function update_rating() {
  $rating_count = $_POST['rating_count'];
  $average_rating = $_POST['average_rating'];

  update_field('vote_count', $rating_count,'options');
  update_field('average_rating', $average_rating,'options');

  wp_die();
}
add_action('wp_ajax_update_rating', 'update_rating');
add_action('wp_ajax_nopriv_update_rating', 'update_rating');
*/

/* Custom Post Types */

/* NSCLC */
register_post_type('nsclc', array(
	'label' => __('NSCLC'),
	'singular_label' => __('NSCLC'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
));
register_post_type('hnscc', array(
	'label' => __('HNSCC'),
	'singular_label' => __('HNSCC'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	//'rewrite'     => array( 'slug' => 'HNSCC' ),
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
));
register_post_type('uc', array(
	'label' => __('UC'),
	'singular_label' => __('UC'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	//'rewrite'     => array( 'slug' => 'UC' ),
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
));

register_post_type('rcc', array(
	'label' => __('RCC'),
	'singular_label' => __('RCC'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	//'rewrite'     => array( 'slug' => 'RCC' ),
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
));

register_post_type('gi', array(
	'label' => __('GI Cancer'),
	'singular_label' => __('GI Cancer'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	//'rewrite'     => array( 'slug' => 'GI' ),
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
));

register_post_type('melanoma', array(
	'label' => __('Melanoma'),
	'singular_label' => __('Melanoma'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	//'rewrite' => true,
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
));

register_post_type('nsclc-profiles', array(
	'label' => __('Patient Profiles'),
	'singular_label' => __('Patient Profiles'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite'     => array('slug' => '/', 'with_front' => false),
	//'rewrite' => true,
	'query_var' => true,
	'has_archive' => false,
	'supports' => array('title', 'editor', 'thumbnail')
));

/* Profiles Categories */
$labels = array('name' => _x('Categories', 'taxonomy general name'));
register_taxonomy('nsclc-profiles-cat', array('nsclc-profiles'), array(
	'hierarchical' => true,
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'nsclc-profiles-cat'),
	'meta_box_cb' => 'custom_taxonomy_meta_box'
));
register_taxonomy_for_object_type('nsclc-profiles-cat', 'nsclc-profiles');

$labels = array('name' => _x('Indications', 'taxonomy general name'));
register_taxonomy('nsclc-profiles-ind', array('nsclc-profiles'), array(
	'hierarchical' => true,
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'nsclc-profiles-ind'),
	'meta_box_cb' => 'custom_taxonomy_meta_box'
));
register_taxonomy_for_object_type('nsclc-profiles-ind', 'nsclc-profiles');


function custom_taxonomy_meta_box( $post ) {
  remove_meta_box( 'nsclc-profiles-catdiv','nsclc-profiles', 'side' );
  remove_meta_box( 'nsclc-profiles-inddiv', 'nsclc-profiles', 'side' );
}

add_action( 'admin_menu', 'custom_taxonomy_meta_box' );


/* HNSCC Categories */
$labels_hnscc = array('name' => _x('Categories', 'taxonomy general name'));
register_taxonomy('hnscc_category', array('hnscc'), array(
	'hierarchical' => true,
	'labels' => $labels_hnscc,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'hnscc_category')
));
register_taxonomy_for_object_type('hnscc_category', 'hnscc');

/* NSCLC Categories  */
$labels = array('name' => _x('Categories', 'taxonomy general name'));
register_taxonomy('nsclc_category', array('nsclc'), array(
	'hierarchical' => true,
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'nsclc_category')
));
register_taxonomy_for_object_type('nsclc_category', 'nsclc');



/* Keynotes */
register_post_type('keynotes', array(
	'label' => __('Keynotes'),
	'singular_label' => __('Keynotes'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => true,
	'has_archive' => true,
	'supports' => array('title', 'editor')
));



/* Site Rating */
register_post_type('site_rating', array(
	'label' => __('Site Rating'),
	'singular_label' => __('Site Rating'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => true,
	'has_archive' => false,
	'menu_icon'   => 'dashicons-star-filled',
	'supports' => array('title', 'editor')
));





/* Shorthand function to get archive link */
function kt_archive_link()
{
	$referrer = wp_get_referer();
	$ref = basename(parse_url($referrer, PHP_URL_PATH));

	if (ICL_LANGUAGE_CODE == 'fr') {
		$fr = pll_home_url($lang = 'fr');
		$nsclc_page = $fr . 'keytruda_NSCLC/';
		$hnscc_page = $fr . 'keytruda_HNSCC/';
		$uc_page = $fr . 'keytruda_UC/';
		$rcc_page = $fr . 'keytruda_RCC/';
		$mel_page = $fr . 'keytruda_melanoma/';
		$cc_page = $fr . 'keytruda_GI_colorectal-cancer/';
	} else {
		$nsclc_page = '/keytruda_NSCLC/';
		$hnscc_page = '/keytruda_HNSCC/';
		$uc_page = '/keytruda_UC/';
		$rcc_page = '/keytruda_RCC/';
		$mel_page = '/keytruda_melanoma/';
		$cc_page = '/keytruda_GI_colorectal-cancer/';
	}

	if ($referrer && $ref == 'resources') {
		if (is_singular('nsclc')) {
			echo $referrer;
		} elseif (is_singular('hnscc')) {
			echo $referrer;
		} elseif (is_singular('uc')) {
			echo $referrer;
		} elseif (is_singular('rcc')) {
			echo $referrer;
		} elseif (is_singular('melanoma')) {
			echo $referrer;
		} elseif (is_singular('gi')) {
			echo $referrer;
		}
	} else {
		if (is_singular('nsclc')) {
			echo $nsclc_page;
		} elseif (is_singular('hnscc')) {
			echo $hnscc_page;
		} elseif (is_singular('uc')) {
			echo $uc_page;
		} elseif (is_singular('rcc')) {
			echo $rcc_page;
		} elseif (is_singular('melanoma')) {
			echo $mel_page;
		} elseif (is_singular('gi')) {
			echo $cc_page;
		}
	}
}

/* Disable default wp search */
function kt_search_filter_query( $query, $error = true ) {
	if ( is_search() && !is_admin() ) {
		$query->is_search = false;
		$query->query_vars['s'] = false;
		$query->query['s'] = false;
		if ( $error == true )
		$query->is_404 = true;
	}
}
add_action( 'parse_query', 'kt_search_filter_query' );


/* Posts redirection */
add_action('template_redirect', 'post_redirection');
function post_redirection()
{
	if (is_singular('keynotes') || is_post_type_archive('keynotes') || is_singular('site_rating')) {
		wp_redirect(home_url());
		exit();
	}
}


/* Polylang String */
add_action('init', function () {
	if(function_exists('pll_register_string')){
		pll_register_string('body_animation', 'HNSCC', 'body_animation');
		pll_register_string('body_animation', 'NSCLC', 'body_animation');
		pll_register_string('body_animation', 'ESO', 'body_animation');
		pll_register_string('body_animation', 'PMBCL', 'body_animation');
		pll_register_string('body_animation', 'Melanoma', 'body_animation');
		pll_register_string('body_animation', 'RCC', 'body_animation');
		pll_register_string('body_animation', 'EC', 'body_animation');
		pll_register_string('body_animation', 'EC Additional', 'body_animation');
		pll_register_string('body_animation', 'CRC', 'body_animation');
		pll_register_string('body_animation', 'UC', 'body_animation');
		pll_register_string('body_animation', 'cHL', 'body_animation');
		pll_register_string('body_animation', 'TNBC', 'body_animation');
		pll_register_string('body_animation', 'CC', 'body_animation');
		pll_register_string('tabs', 'KEYTRUDA<sup>®</sup> in HNSCC', 'tabs');
		pll_register_string('tabs', 'Clinical studies in HNSCC', 'tabs');
		pll_register_string('tabs', 'Colorectal cancer', 'tabs');
		pll_register_string('tabs', 'Esophageal cancer', 'tabs');
		pll_register_string('tabs', 'KEYTRUDA<sup>®</sup> in melanoma', 'tabs');
		pll_register_string('tabs', 'Clinical studies in melanoma', 'tabs');
		pll_register_string('tabs', 'KEYTRUDA<sup>®</sup> in NSCLC', 'tabs');
		pll_register_string('tabs', 'Clinical studies in NSCLC', 'tabs');
		pll_register_string('tabs', 'KEYTRUDA<sup>®</sup> + axitinib in RCC', 'tabs');
		pll_register_string('tabs', 'Clinical studies in RCC', 'tabs');
		pll_register_string('uc', 'KEYTRUDA<sup>®</sup> in UC1', 'uc');
		pll_register_string('tabs', 'Clinical studies in UC', 'tabs');
		pll_register_string('tabs', 'Clinical program in NSCLC', 'tabs');
		pll_register_string('back', 'Back', 'back');
		pll_register_string('nav', 'Previous', 'nav');
		pll_register_string('nav', 'Next', 'nav');
		pll_register_string('button', 'Learn more', 'button');
		pll_register_string('faq', 'Melanoma', 'faq');
		pll_register_string('faq', 'Non-small cell lung cancer', 'faq');
		pll_register_string('faq', 'Urothelial carcinoma', 'faq');
		pll_register_string('faq', 'Renal cell carcinoma', 'faq');
		pll_register_string('faq', 'Colorectal cancer', 'faq');
		pll_register_string('faq', 'Head and neck squamous cell carcinoma', 'faq');
		pll_register_string('pivotal-title', 'Pivotal trial overview', 'pivotal-title');
		pll_register_string('circle', 'Median survival <strong>not reached</strong> for KEYTRUDA<sup>®</sup> + plat/pem', 'circle');
		pll_register_string('circle', 'Overall survival rate', 'circle');
		pll_register_string('tabs_two', 'Overall survival', 'tabs_two');
		pll_register_string('tabs_two', 'Objective response rate', 'tabs_two');
		pll_register_string('tabs_two', 'Duration of response', 'tabs_two');
		pll_register_string('indications', 'Indications:', 'indications');

		pll_register_string('tabs', 'Study Design', 'tabs');
		pll_register_string('tabs', 'Efficacy Results', 'tabs');
		pll_register_string('tabs', 'Safety Profile', 'tabs');
	}
});


function remove_max_srcset_image_width($max_width)
{
	return false;
}
add_filter('max_srcset_image_width', 'remove_max_srcset_image_width');
function wdo_disable_srcset($sources)
{
	return false;
}
add_filter('wp_calculate_image_srcset', 'wdo_disable_srcset');


add_filter('permalink_manager_force_lowercase_uris', '__return_false');

function redirection_rules()
{
	if (is_page(1785)) {
		wp_redirect(home_url());
		exit();
	}
	if (is_page(1833)) {
		wp_redirect(home_url());
		exit();
	}
	/*
  if(is_page(1787)){
  	wp_redirect(get_permalink(974)); 
  	exit();
  }
  if(is_page(1804)){
  	wp_redirect(get_permalink(982));
  	exit();
  }
  */
}
add_action('template_redirect', 'redirection_rules');


/* Body Classes */
add_filter('body_class', 'kt_body_classes');
function kt_body_classes($classes)
{
	if (is_page_template('page-melanoma.php') || is_page_template('page-melanoma-clinical.php')) {
		$classes[] = 'post-type-archive';
		$classes[] = 'post-type-archive-melanoma';
	} elseif (is_page_template('page-uc.php') || is_page_template('page-uc-clinical.php')) {
		$classes[] = 'post-type-archive';
		$classes[] = 'post-type-archive-uc';
	} elseif (is_page_template('page-rcc.php') || is_page_template('page-rcc-clinical.php')) {
		$classes[] = 'post-type-archive';
		$classes[] = 'post-type-archive-rcc';
	} elseif (is_page_template('page-gi.php') || is_page_template('page-gi-clinical.php')) {
		$classes[] = 'post-type-archive';
		$classes[] = 'post-type-archive-gi';
	} elseif (is_page_template('page-hnscc.php') || is_page_template('page-hnscc-clinical.php')) {
		$classes[] = 'post-type-archive';
		$classes[] = 'post-type-archive-hnscc';
	} elseif (is_page_template('page-nsclc.php') || is_page_template('page-nsclc-clinical.php') || is_page_template('page-nsclc-program.php') || is_page_template('page-nsclc-patient.php')) {
		$classes[] = 'post-type-archive';
		$classes[] = 'post-type-archive-nsclc';
	}

	return $classes;
}

add_filter('permalink_manager_force_lowercase_uris', '__return_false');
remove_filter('sanitize_title', 'sanitize_title_with_dashes');

add_filter('sanitize_title', 'permalinks_update', 10, 3);
function permalinks_update($title, $raw_title, $context = 'display')
{

	$title = strip_tags($raw_title);
	// Preserve escaped octets.
	$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	// Remove percent signs that are not part of an octet.
	$title = str_replace('%', '', $title);
	// Restore octets.
	$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

	if (seems_utf8($title)) {
		$title = utf8_uri_encode(utf8_encode($title), 200);
	}
	if ('save' === $context) {
		// Convert &nbsp, &ndash, and &mdash to hyphens.
		$title = str_replace(array('%c2%a0', '%e2%80%93', '%e2%80%94'), '-', $title);
		// Convert &nbsp, &ndash, and &mdash HTML entities to hyphens.
		$title = str_replace(array('&nbsp;', '&#160;', '&ndash;', '&#8211;', '&mdash;', '&#8212;'), '-', $title);
		// Convert forward slash to hyphen.
		$title = str_replace('/', '-', $title);

		// Strip these characters entirely.
		$title = str_replace(
			array(
				// Soft hyphens.
				'%c2%ad',
				// &iexcl and &iquest.
				'%c2%a1',
				'%c2%bf',
				// Angle quotes.
				'%c2%ab',
				'%c2%bb',
				'%e2%80%b9',
				'%e2%80%ba',
				// Curly quotes.
				'%e2%80%98',
				'%e2%80%99',
				'%e2%80%9c',
				'%e2%80%9d',
				'%e2%80%9a',
				'%e2%80%9b',
				'%e2%80%9e',
				'%e2%80%9f',
				// Bullet.
				'%e2%80%a2',
				// &copy, &reg, &deg, &hellip, and &trade.
				'%c2%a9',
				'%c2%ae',
				'%c2%b0',
				'%e2%80%a6',
				'%e2%84%a2',
				// Acute accents.
				'%c2%b4',
				'%cb%8a',
				'%cc%81',
				'%cd%81',
				// Grave accent, macron, caron.
				'%cc%80',
				'%cc%84',
				'%cc%8c',
			),
			'',
			$title
		);

		// Convert &times to 'x'.
		$title = str_replace('%c3%97', 'x', $title);
	}
	// Kill entities.
	$title = preg_replace('/&.+?;/', '', $title);
	$title = str_replace('.', '-', $title);

	$title = preg_replace('/[^%a-zA-Z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	$title = preg_replace('|-+|', '-', $title);
	$title = trim($title, '-');

	return $title;
}

/* Remove cpt slugs */
function na_remove_slug($post_link, $post, $leavename)
{

	if (('nscls' != $post->post_type || 'hnscc' != $post->post_type || 'uc' != $post->post_type || 'rcc' != $post->post_type || 'melanoma' != $post->post_type || 'gi' != $post->post_type) || 'publish' != $post->post_status) {
		return $post_link;
	}

	$post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);

	return $post_link;
}
add_filter('post_type_link', 'na_remove_slug', 10, 3);

function na_parse_request($query)
{

	if (!$query->is_main_query() || 2 != count($query->query) || !isset($query->query['page'])) {
		return;
	}

	if (!empty($query->query['name'])) {
		$query->set('post_type', array('post', 'nsclc', 'hnscc', 'uc', 'rcc', 'gi', 'melanoma', 'page'));
	}
}
add_action('pre_get_posts', 'na_parse_request');



/* Additional Columns for Site Rating */
function kt_add_rating_column($columns) {
    $columns['rating'] = __('Rating','Site Rating');
    return $columns;
}
add_filter('manage_site_rating_posts_columns', 'kt_add_rating_column');

// Populate custom column with data
function kt_display_rating_column($column, $post_id) {
    if ($column === 'rating') {
        $rating = get_field('average_rating', $post_id);
        echo $rating;
    }
}
add_action('manage_site_rating_posts_custom_column', 'kt_display_rating_column', 10, 2);

// Add sorting capability to custom column
function kt_rating_column_sortable($columns) {
    $columns['rating'] = 'rating';
    return $columns;
}
add_filter('manage_edit-site_rating_sortable_columns', 'kt_rating_column_sortable');

// Modify query to sort by rating
function kt_rating_column_orderby($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('orderby') !== 'rating') {
        return;
    }
    $query->set('meta_key', 'average_rating');
    $query->set('orderby', 'meta_value_num');
}
add_action('pre_get_posts', 'kt_rating_column_orderby');


function kt_average_rating_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=site_rating',
        __('Average Rating', 'Site Rating'),
        __('Average Rating', 'Site Rating'),
        'manage_options',
        'site_rating_average_rating',
        'kt_display_average_rating_submenu_page'
    );
}
add_action('admin_menu', 'kt_average_rating_submenu_page');

// Display custom submenu page
function kt_display_average_rating_submenu_page() {
    $average_rating = calculate_average_rating();
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Average Rating', 'Site Rating'); ?></h1>
        <p><?php esc_html_e('The average rating is:', 'Site Rating'); ?> <?php echo $average_rating; ?></p>
    </div>
    <?php
}

// Add custom meta box to submenu page
function add_average_rating_meta_box() {
    add_meta_box(
        'site_rating_average_rating',
        __('Average Rating', 'Site Rating'),
        'kt_display_average_rating_meta_box',
        'site_rating',
        'side',
        'default'
    );
}
add_action('admin_init', 'add_average_rating_meta_box');

// Display custom meta box
function kt_display_average_rating_meta_box($post) {
    $average_rating = calculate_average_rating();
    ?>
    <p><?php esc_html_e('The average rating is:', 'Site Rating'); ?> <?php echo $average_rating; ?></p>
    <?php
}

// Calculate average rating for all posts
function calculate_average_rating() {
    $args = array(
        'post_type' => 'site_rating',
        'meta_query' => array(
            array(
                'key' => 'average_rating',
                'compare' => 'EXISTS',
            ),
        ),
    );
    $query = new WP_Query($args);
    $total_rating = 0;
    $num_posts = 0;
    while ($query->have_posts()) {
        $query->the_post();
        $rating = get_field('average_rating');
        $total_rating += $rating;
        $num_posts++;
    }
    wp_reset_postdata();
    if ($num_posts > 0) {
        return round($total_rating / $num_posts);
    } else {
        return '-';
    }
}