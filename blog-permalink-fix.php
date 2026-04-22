<?php
/**
 * Plugin Name: Blog Permalink Fix
 * Plugin URI:  https://github.com/lifexmarketing/wpblogpermafix
 * Description: Prevents custom post types from inheriting the /blog/ permalink front. Only built-in posts use /blog/%postname%/.
 * Version:     1.0.2
 * Author:      LifeX Marketing
 * License:     GPL-2.0-or-later
 */

require_once __DIR__ . '/vendor/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5p6\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/lifexmarketing/wpblogpermafix/',
	__FILE__,
	'blog-permalink-fix'
);

add_filter( 'register_post_type_args', function( $args, $post_type ) {
	$built_in = [ 'post', 'page', 'attachment', 'revision', 'nav_menu_item' ];

	if ( in_array( $post_type, $built_in, true ) ) {
		return $args;
	}

	if ( ! isset( $args['rewrite'] ) ) {
		$args['rewrite'] = [];
	}

	if ( is_array( $args['rewrite'] ) ) {
		$args['rewrite']['with_front'] = false;
	}

	return $args;
}, 10, 2 );
