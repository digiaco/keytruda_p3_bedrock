<?php
/*
Semantic Framework
Version: 1.6.2
*/

// Core
include('inc/core.php');

// Site Specific
include('inc/custom.php');


/**
 * Disable the fatal error handler.
 */
add_filter( 'wp_fatal_error_handler_enabled', '__return_false' );


/* Remove all JSON output by Yoast SEO
 * Credit: Yoast development team
 * Documentation: https://developer.yoast.com/schema-documentation/api/
 * Last Tested: Apr 16 2019 using Yoast SEO 11.0 on WordPress 5.1.1
 */

add_filter( 'wpseo_json_ld_output', '__return_false' );