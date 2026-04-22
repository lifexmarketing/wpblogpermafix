<?php
/**
 * Plugin Name: Blog Permalink Fix
 * Description: Prevents custom post types from inheriting the /blog/ permalink front. Only built-in posts use /blog/%postname%/.
 * Version: 1.0.0
 */

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
