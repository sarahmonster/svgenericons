<?php
/**
 * SVGenericons
 *
 * This feature will only be activated for themes that declare their support.
 * This can be done by adding code similar to the following during the
 * 'after_setup_theme' action:
 *
 * add_theme_support( 'jetpack-svgenericons' );
 */

/**
 * Activate the SVGenericons plugin.
 *
 * @uses current_theme_supports()
 */
function jetpack_svgenericons_init() {
	// Only load our code if our theme declares support
	if ( ! current_theme_supports( 'jetpack-svgenericons' ) ) {
		return;
	}
	add_action( 'wp_enqueue_scripts', 'jetpack_svgenericons_styles' );
}
add_action( 'after_setup_theme', 'jetpack_svgenericons_init', 99 );

/* Enqueue our CSS */
function jetpack_svgenericons_styles() {
	wp_enqueue_style( 'jetpack-svgenericons', plugins_url( 'svgenericons/svgenericons.css', __FILE__ ), array(), '1.0' );
}

/*
 * Inject our SVG sprite at the bottom of the page
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 */
function jetpack_svgenericons_inject_sprite() {
	 $file_path = $dir = plugin_dir_path( __FILE__ );
	 include_once( $file_path .'svgenericons/svgenericons.svg' );
}
add_filter( 'wp_footer' , 'jetpack_svgenericons_inject_sprite' );
