<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-PX9TQ3W');
	</script>

	<?php
	$check_site = $_SERVER['SERVER_NAME'];
	if ($check_site == 'decouvrezpembro.ca') {
		$domain_script = 'c4629065-d961-4796-be7e-c0b0cc620f88';
	} else {
		$domain_script = 'd3bf6ebe-204f-4366-8138-c11d7cddcbf0-test';
	}
	if (defined('ICL_LANGUAGE_CODE')) {
		if(ICL_LANGUAGE_CODE == 'en'){
			if ($check_site == 'gettoknowpembro.ca') {
				$domain_script = 'd380f968-8c2d-41a1-9cdd-1c1152b71249';
			} else {
				$domain_script = 'd3bf6ebe-204f-4366-8138-c11d7cddcbf0-test';
			}
		}
	} 
	?>

	<script src="https://cdn.cookielaw.org/scripttemplates/otSDKStub.js" type="text/javascript" charset="UTF-8" data-document-language="true" data-domain-script="<?php echo $domain_script; ?>"></script>
	<script type="text/javascript">
		function OptanonWrapper() {}
	</script>

	<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="robots" content="noodp">
	<?php wp_head(); ?>
	<?php
 if(isset($_GET['esophageal_cancer'])){	
		$add_class = "eso";
 } else {
  $add_class = "";
 } 
	

	if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') {
		$home_url = home_url() . '/keytruda_homepage/';
	} else {
		if(function_exists('pll_home_url')){
			$home_url = pll_home_url('en') . 'keytruda_fr_pantumour/';
		} else {
			$home_url = home_url() . '/keytruda_homepage/';
		}
	}

	$logo_url = get_field('logo_url', 'options');
	if ($logo_url) {
		$logo_url = $logo_url;
	} else {
		$logo_url = $home_url;
	}
	?>

</head>

<body <?php body_class($add_class); ?>>
	<!-- Google Tag Manager (noscript) -->

	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PX9TQ3W" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<!-- End Google Tag Manager (noscript) -->
	<div id="page">
		<?php if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') { ?>
			<a class="skip-link" id="skip-link" tabindex="0" href="#container">Skip to content</a>
		<?php } else { ?>
			<a class="skip-link" id="skip-link" tabindex="0" href="#container">Aller au contenu</a>
		<?php } ?>
		<header id="branding">
			<div class="top-nav">
				<div class="content-wrapper">
					<ul>
						<?php site_menu('Top Menu'); ?>
						<?php if(function_exists('pll_the_languages')){ ?>
							<?php pll_the_languages(array('display_names_as' => 'slug')); ?>
						<?php } ?>
					</ul>
				</div>
			</div>
			<nav>
				<a tabindex="-1" class="mobile-logo" aria-hidden="true" href="<?php echo $logo_url; ?>"> <img src="<?php echo get_template_directory_uri(); ?>/assets/img/main-logo.svg" aria-hidden="true" alt="Get to know KEYTRUDA®" title="Get to know KEYTRUDA®" id="mobile-logo">Keytruda</a>
				<span class="mobile-btn"><span></span></span>
				<div class="content-wrapper">
					<a class="logo-placer" href="<?php echo $logo_url; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/main-logo.svg" alt="Get to know KEYTRUDA®" title="Get to know KEYTRUDA®" id="logo"></a>
					<ul id="main-nav">
						<?php site_menu('Main Menu', 2); ?>
					</ul>
					<ul class="bottom-nav">
						<?php site_menu('Top Menu'); ?>
						<?php if(function_exists('pll_the_languages')){ ?>
							<?php pll_the_languages(array('display_names_as' => 'slug')); ?>
						<?php } ?>
					</ul>
				</div>
			</nav>
		</header>
		<?php if(is_page_template('page-study-results.php') || is_page_template('page-patient.php') || is_page_template('page-indications.php') ) { ?>
			<?php get_template_part('partials/banner-new'); ?>
		<?php } else { ?>
			<?php get_template_part('partials/banner'); ?>
		<?php } ?>	
		
		<main id="container" tabindex="0">